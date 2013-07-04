<?php

namespace spec\Cavis\Core\Usecase\Image;

use PHPSpec2\ObjectBehavior;

class Vote extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\User $user
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Vote\Repository $image_vote
     */
    function let($user, $image, $image_vote)
    {
        $data = array(
            'user' => $user,
            'image' => $image
        );

        $repositories = array(
            'image_vote' => $image_vote
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Vote');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Image\Vote\Interactor');
    }
}
