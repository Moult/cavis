<?php

namespace spec\Cavis\Core\Usecase\Category;

use PHPSpec2\ObjectBehavior;

class Delete extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Category\Delete\Repository $category_delete
     */
    function let($category, $category_delete)
    {
        $data = array(
            'category' => $category
        );

        $repositories = array(
            'category_delete' => $category_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Delete');
    }

    function it_should_fetch_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Category\Delete\Interactor');
    }
}
