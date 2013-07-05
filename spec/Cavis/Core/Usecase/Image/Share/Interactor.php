<?php

namespace spec\Cavis\Core\Usecase\Image\Share;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Share\Recipient $recipient
     */
    function let($image, $recipient)
    {
        $this->beConstructedWith($image, $recipient);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Share\Interactor');
    }

    function it_runs_the_interaction_chain($image, $recipient)
    {
        $recipient->validate()->shouldBeCalled();
        $recipient->notify($image)->shouldBeCalled();
        $this->interact();
    }
}
