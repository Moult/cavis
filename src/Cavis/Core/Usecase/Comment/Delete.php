<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment;
use Cavis\Core\Usecase\Comment\Delete\Interactor;

class Delete
{
    private $data;
    private $repositories;

    public function __construct(Array $data, Array $repositories)
    {
        $this->data = $data;
        $this->repositories = $repositories;
    }

    public function fetch()
    {
        return new Interactor(
            $this->data['comment'],
            $this->repositories['comment_delete']
        );
    }
}
