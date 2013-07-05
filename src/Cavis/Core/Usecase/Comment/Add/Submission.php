<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment\Add;
use Cavis\Core\Data;
use Cavis\Core\Tool;
use Cavis\Core\Exception;

class Submission extends Data\Comment
{
    public function __construct(Data\Comment $comment, Repository $repository, Tool\Validator $validator)
    {
        $this->message = $comment->message;
        $this->image = $comment->image;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'message' => $this->message,
            'image_id' => $this->image->id
        ));
        $this->validator->rule('message', 'not_empty');
        $this->validator->callback('image_id', array($this, 'is_existing_image'), array('image_id'));
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_existing_image($image_id)
    {
        return $this->repository->check_image_exists($image_id);
    }

    public function submit()
    {
        $this->repository->save_comment($this->message, $this->image->id);
    }
}
