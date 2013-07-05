<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Share extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Data\User $user
     * @param Cavis\Core\Tool\Emailer $emailer
     * @param Cavis\Core\Tool\Formatter $formatter
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($image, $user, $emailer, $formatter, $validator)
    {
        $data = array(
            'image' => $image,
            'user' => $user
        );

        $tools = array(
            'emailer' => $emailer,
            'formatter' => $formatter,
            'validator' => $validator
        );

        $this->beConstructedWith($data, $tools);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Share');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\Share\Interactor');
    }
}
