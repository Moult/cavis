<?php

namespace spec\Cavis\Core\Usecase\Image\Add;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Image\Add\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Add\Interactor');
    }

    function it_should_run_the_interaction_chain($submission)
    {
        $submission->validate()->shouldBeCalled();
        $submission->is_wider_than_layout()->shouldBeCalled()->willReturn(TRUE);
        $submission->resize_to_layout()->shouldBeCalled();
        $submission->generate_background()->shouldBeCalled();
        $submission->generate_thumbnail()->shouldBeCalled();
        $submission->submit()->shouldBeCalled()->willReturn(42);
        $this->interact()->shouldReturn(42);
    }
}
