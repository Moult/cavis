<?php

namespace spec\Cavis\Core\Usecase\Category\Add;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Category\Add\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Add\Interactor');
    }

    function it_should_run_the_interaction_chain($submission)
    {
        $submission->validate()->shouldBeCalled();
        $submission->submit()->shouldBeCalled();
        $this->interact();
    }
}
