<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Add;
use Cavis\Core\Data;
use Cavis\Core\Tool;
use Cavis\Core\Exception;

class Submission extends Data\Image
{
    public function __construct(Data\Image $image, Repository $repository, Tool\Photoshopper $photoshopper, Tool\Validator $validator)
    {
        $this->name = $image->name;
        $this->author = $image->author;
        $this->website = $image->website;
        $this->email = $image->email;
        $this->summary = $image->summary;
        $this->description = $image->description;
        $this->file = $image->file;
        $this->supplementary_files = $image->supplementary_files;
        $this->category = $image->category;
        $this->repository = $repository;
        $this->photoshopper = $photoshopper;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'author' => $this->author,
            'website' => $this->website,
            'email' => $this->email,
            'summary' => $this->summary,
            'description' => $this->description,
            'file' => array(
                'name' => $this->file->name,
                'tmp_name' => $this->file->tmp_name,
                'type' => $this->file->mimetype,
                'size' => $this->file->filesize_in_bytes,
                'error' => $this->file->error_code
            ),
            'category_id' => $this->category->id
        ));

        $this->validator->rule('name', 'not_empty');
        $this->validator->rule('name', 'max_length', 60);
        $this->validator->rule('author', 'not_empty');
        $this->validator->rule('author', 'max_length', 60);
        $this->validator->rule('website', 'url');
        $this->validator->rule('email', 'email');
        $this->validator->rule('summary', 'not_empty');
        $this->validator->rule('description', 'not_empty');
        $this->validator->rule('file', 'upload_not_empty');
        $this->validator->rule('file', 'upload_valid');
        $this->validator->rule('file', 'upload_type', array('jpg', 'png', 'jpeg'));
        $this->validator->rule('file', 'upload_size', '3M');
        $this->validator->callback('category_id', array($this, 'is_an_existing_category_id'), array('category_id'));
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function validate_supplementary_files()
    {
        foreach ($this->supplementary_files as $file)
        {
            $this->validator->setup(array(
                'supplementary_file' => array(
                    'name' => $file->name,
                    'tmp_name' => $file->tmp_name,
                    'type' => $file->mimetype,
                    'size' => $file->filesize_in_bytes,
                    'error' => $file->error_code
                )
            ));
            $this->validator->rule('supplementary_file', 'upload_valid');
            $this->validator->rule('supplementary_file', 'upload_type', array('jpg', 'png', 'jpeg'));
            $this->validator->rule('supplementary_file', 'upload_size', '3M');
            if ( ! $this->validator->check())
                throw new Exception\Validation($this->validator->errors());
        }
    }

    public function is_an_existing_category_id($id)
    {
        return $this->repository->does_category_exist($id);
    }

    public function is_wider_than_layout()
    {
        $this->photoshopper->setup($this->file->tmp_name);
        return ($this->photoshopper->get_width() > 1200);
    }

    public function resize_to_layout()
    {
        $this->photoshopper->setup($this->file->tmp_name);
        $this->photoshopper->resize_to_width(1200);
    }

    public function resize_supplementary_files()
    {
        foreach ($this->supplementary_files as $file)
        {
            if (empty($file))
                continue;

            $this->photoshopper->setup($file->tmp_name);
            $this->photoshopper->resize_to_width(600);
        }
    }

    public function generate_thumbnail()
    {
        $this->thumbnail = new Data\File;
        $this->photoshopper->setup($this->file->tmp_name, $this->file->tmp_name.'.thumb.png');
        $this->photoshopper->resize_to_width(222);
        $this->thumbnail->full_path = $this->file->tmp_name.'.thumb.png';
    }

    public function submit()
    {
        $supplementary_file_paths = array();
        foreach ($this->supplementary_files as $file)
        {
            $supplementary_file_paths[] = $this->repository->save_file($file);
        }

        return $this->repository->save_image(
            $this->name,
            $this->repository->save_file($this->thumbnail),
            $this->repository->save_file($this->file),
            $supplementary_file_paths,
            $this->category->id
        );
    }
}
