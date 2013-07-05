<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Browse extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Usecase\Image\Browse\Repository $image_browse
     */
    function let($image_browse)
    {
        $repositories = array(
            'image_browse' => $image_browse
        );

        $this->beConstructedWith($repositories);
    }
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Browse');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\Browse\Interactor');
    }
}
