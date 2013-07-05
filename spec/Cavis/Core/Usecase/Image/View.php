<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class View extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\View\Repository $image_view
     */
    function let($image, $image_view)
    {
        $data = array(
            'image' => $image
        );

        $repositories = array(
            'image_view' => $image_view
        );

        $this->beConstructedWith($data, $repositories);
    }
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\View');
    }

    function it_should_fetch_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\View\Interactor');
    }
}
