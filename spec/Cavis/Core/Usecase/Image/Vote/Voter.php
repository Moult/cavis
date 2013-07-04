<?php

namespace spec\Cavis\Core\Usecase\Image\Vote;

use PHPSpec2\ObjectBehavior;

class Voter extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\User $user
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Vote\Repository $repository
     */
    function let($user, $image, $repository)
    {
        $user->ip = '127.0.0.1';
        $image->id = 42;
        $this->beConstructedWith($user, $image, $repository);
        $this->ip->shouldBe('127.0.0.1');
        $this->vote->shouldBe(42);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Vote\Voter');
    }

    function it_should_be_a_user()
    {
        $this->shouldHaveType('Cavis\Core\Data\User');
    }

    function it_authorises_the_voter($repository)
    {
        $repository->has_existing_vote('127.0.0.1', 42)->shouldBeCalled()->willReturn(FALSE);
        $this->authorise();
    }

    function it_unauthorises_existing_voters($repository)
    {
        $repository->has_existing_vote('127.0.0.1', 42)->shouldBeCalled()->willReturn(TRUE);
        $this->shouldThrow('Cavis\Core\Exception\Authorisation')
            ->duringAuthorise();
    }

    function it_can_vote($repository)
    {
        $repository->save_vote('127.0.0.1', 42)->shouldBeCalled();
        $this->vote();
    }
}
