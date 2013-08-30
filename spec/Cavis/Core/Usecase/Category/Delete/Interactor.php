<?php

namespace spec\Cavis\Core\Usecase\Category\Delete;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Category\Delete\Repository $repository
     */
    function let($category, $repository)
    {
        $category->id = 'id';
        $this->beConstructedWith($category, $repository);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Delete\Interactor');
    }

    function it_should_run_the_interaction_chain($repository)
    {
        $repository->delete_category('id')->shouldBeCalled();
        $this->interact();
    }
}
