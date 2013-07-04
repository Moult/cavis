<?php

namespace spec\Cavis\Core\Usecase\Image\Vote;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Image\Vote\Voter $voter
     */
    function let($voter)
    {
        $this->beConstructedWith($voter);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Vote\Interactor');
    }

    function it_runs_the_interaction_chain($voter)
    {
        $voter->authorise()->shouldBeCalled();
        $voter->vote()->shouldBeCalled();
        $this->interact();
    }
}
