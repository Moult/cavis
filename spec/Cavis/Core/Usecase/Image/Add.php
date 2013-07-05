<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Add extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Add\Repository $image_add
     * @param Cavis\Core\Tool\Photoshopper $photoshopper
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($image, $image_add, $photoshopper, $validator)
    {
        $data = array(
            'image' => $image
        );

        $repositories = array(
            'image_add' => $image_add
        );

        $tools = array(
            'photoshopper' => $photoshopper,
            'validator' => $validator
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
