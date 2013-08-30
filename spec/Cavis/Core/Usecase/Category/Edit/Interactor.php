<?php

namespace spec\Cavis\Core\Usecase\Category\Edit;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Category\Edit\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Edit\Interactor');
    }

    function it_should_run_the_interaction_chain($submission)
    {
        $submission->validate()->shouldBeCalled();
        $submission->update()->shouldBeCalled();
        $this->interact();
    }
}
