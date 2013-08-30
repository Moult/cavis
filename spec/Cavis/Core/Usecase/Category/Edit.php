<?php

namespace spec\Cavis\Core\Usecase\Category;

use PHPSpec2\ObjectBehavior;

class Edit extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Category\Edit\Repository $category_edit
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($category, $category_edit, $validator)
    {
        $data = array(
            'category' => $category
        );

        $repositories = array(
            'category_edit' => $category_edit
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Edit');
    }

    function it_should_fetch_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Category\Edit\Interactor');
    }
}
