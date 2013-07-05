<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment;
use Cavis\Core\Usecase\Comment\Add\Interactor;
use Cavis\Core\Usecase\Comment\Add\Submission;

class Add
{
    private $data;
    private $repositories;

    public function __construct(Array $data, Array $repositories, Array $tools)
    {
        $this->data = $data;
        $this->repositories = $repositories;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->get_submission()
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['comment'],
            $this->repositories['comment_add'],
            $this->tools['validator']
        );
    }
}
