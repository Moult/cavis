<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Add extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Add\Repository $image_add
     * @param Cavis\Core\Tool\Graphic $graphic
     * @param Cavis\Core\Tool\Filesystem $filesystem
     * @param Cavis\Core\Tool\Validation $validation
     */
    function let($image, $image_add, $graphic, $filesystem, $validation)
    {
        $data = array(
            'image' => $image
        );

        $repositories = array(
            'image_add' => $image_add
        );

        $tools = array(
            'graphic' => $graphic,
            'filesystem' => $filesystem,
            'validation' => $validation
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Add');
    }

    function it_should_fetch_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\Add\Interactor');
    }
}
