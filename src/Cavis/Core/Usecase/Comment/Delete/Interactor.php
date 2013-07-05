<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment\Delete;
use Cavis\Core\Data;

class Interactor
{
    public function __construct(Data\Comment $comment, Repository $repository)
    {
        $this->comment = $comment;
        $this->repository = $repository;
    }

    public function interact()
    {
        $this->repository->delete_comment($this->comment->id);
    }
}
