<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Delete extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Delete\Repository $image_delete
     */
    function let($image, $image_delete)
    {
        $data = array(
            'image' => $image
        );

        $repositories = array(
            'image_delete' => $image_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Delete');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\Delete\Interactor');
    }
}
