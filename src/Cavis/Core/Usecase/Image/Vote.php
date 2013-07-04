<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image;
use Cavis\Core\Usecase\Image\Vote\Interactor;
use Cavis\Core\Usecase\Image\Vote\Voter;

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
            $this->data['image'],
            $this->repositories['image_vote']
        );
    }
}
