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
    public function __construct(Data\Image $image, Tool\Validation $validation)
    {
        $this->name = $image->name;
        $this->file = $image->file;
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
}
