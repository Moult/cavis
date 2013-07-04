<?php

namespace spec\Cavis\Core\Usecase\Image\Delete;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Image\Delete\Repository $repository
     */
    function let($image, $repository)
    {
        $image->id = 42;
        $this->beConstructedWith($image, $repository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Delete\Interactor');
    }

    function it_should_run_the_interaction_chain($repository)
    {
        $repository->delete(42)->shouldBeCalled();
        $this->interact();
    }
}
