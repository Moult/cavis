<?php

namespace spec\Cavis\Core\Usecase\Image\View;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\View\Repository $repository
     */
    function let($image, $repository)
    {
        $image->id = 42;
        $this->beConstructedWith($image, $repository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\View\Interactor');
    }

    function it_should_fetch_single_image_data($image, $repository)
    {
        $repository->get_all_image_data(42)->shouldBeCalled()->willReturn('foo');
        $this->interact()->shouldReturn('foo');
    }
}
