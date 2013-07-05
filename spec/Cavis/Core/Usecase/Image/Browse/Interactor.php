<?php

namespace spec\Cavis\Core\Usecase\Image\Browse;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Image\Browse\Repository $repository
     */
    function let($repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Browse\Interactor');
    }

    function it_should_run_the_interaction_chain($repository)
    {
        $repository->get_snapshot_of_latest_images()->shouldBeCalled()->willReturn('foo');
        $this->interact()->shouldReturn('foo');
    }
}
