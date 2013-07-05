<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment;
use Cavis\Core\Usecase\Comment\Vote\Interactor;
use Cavis\Core\Usecase\Comment\Vote\Voter;

class Vote
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
            $this->get_voter()
        );
    }

    private function get_voter()
    {
        return new Voter(
            $this->data['user'],
            $this->data['comment'],
            $this->repositories['comment_vote']
        );
    }
}
