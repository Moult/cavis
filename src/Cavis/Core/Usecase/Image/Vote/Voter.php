<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Vote;
use Cavis\Core\Data;
use Cavis\Core\Exception;

class Voter extends Data\User
{
    public function __construct(Data\User $user, Data\Image $image, Repository $repository)
    {
        $this->ip = $user->ip;
        $this->vote = $image->id;
        $this->repository = $repository;
    }

    public function authorise()
    {
        if ($this->repository->has_existing_vote($this->ip, $this->vote))
            throw new Exception\Authorisation('You have already voted.');
    }

    public function vote()
    {
        $this->repository->save_vote($this->ip, $this->vote);
    }
}
