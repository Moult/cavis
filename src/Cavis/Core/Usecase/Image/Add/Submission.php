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
    public function __construct(Data\Image $image, Repository $repository, Tool\Graphic $graphic, Tool\Filesystem $filesystem, Tool\Validation $validation)
    {
        $this->name = $image->name;
        $this->file = $image->file;
        $this->repository = $repository;
        $this->graphic = $graphic;
        $this->filesystem = $filesystem;
        $this->validation = $validation;
    }

    public function validate()
    {
        $this->validation->setup(array(
            'name' => $this->name,
            'file' => $this->file,
        ));
        $this->validation->rule('name', 'not_empty');
        $this->validation->rule('name', 'max_length', 30);
        $this->validation->rule('file', 'upload_valid');
        $this->validation->rule('file', 'upload_type', array('jpg', 'png', 'jpeg'));
        $this->validation->rule('file', 'upload_size', '1M');
        if ( ! $this->validation->check())
            throw new Exception\Validation($this->validation->errors());
    }

    public function is_wider_than_layout()
    {
        return ($this->graphic->get_width($this->file->tmp_name) > 474);
    }

    public function resize_to_layout()
    {
        $this->graphic->resize_to_width($this->file->tmp_name, 474);
    }

    public function generate_background()
    {
        $this->graphic->blur($this->file->tmp_name, 978, $this->file->tmp_name.'.blur');
    }

    public function generate_cropped_thumbnail()
    {
        $this->graphic->crop_thumbnail($this->file->tmp_name, 222, $this->file->tmp_name.'.thumb');
    }

    public function submit()
    {
        $file_path = $this->filesystem->save_upload($this->file);
        $this->filesystem->move($this->file->tmp_name.'.blur', $file_path.'.blur');
        $this->filesystem->move($this->file->tmp_name.'.thumb', $file_path.'.thumb');
        $this->repository->save($this->name, $file_path);
    }
}
