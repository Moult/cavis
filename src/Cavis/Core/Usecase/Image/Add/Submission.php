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
        $this->file = $image->file;
        $this->category = $image->category;
        $this->repository = $repository;
        $this->photoshopper = $photoshopper;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
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
        $this->validator->rule('name', 'max_length', 30);
        $this->validator->rule('file', 'upload_not_empty');
        $this->validator->rule('file', 'upload_valid');
        $this->validator->rule('file', 'upload_type', array('jpg', 'png', 'jpeg'));
        $this->validator->rule('file', 'upload_size', '1M');
        $this->validator->callback('category_id', array($this, 'is_an_existing_category_id'), array('category_id'));
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_an_existing_category_id($id)
    {
        return $this->repository->does_category_exist($id);
    }

    public function is_wider_than_layout()
    {
        $this->photoshopper->setup($this->file->tmp_name);
        return ($this->photoshopper->get_width() > 474);
    }

    public function resize_to_layout()
    {
        $this->photoshopper->setup($this->file->tmp_name);
        $this->photoshopper->resize_to_width(474);
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
        return $this->repository->save_image(
            $this->name,
            $this->repository->save_file($this->thumbnail),
            $this->repository->save_file($this->file),
            $this->category->id
        );
    }
}
