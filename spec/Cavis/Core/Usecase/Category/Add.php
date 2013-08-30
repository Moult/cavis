<?php

namespace spec\Cavis\Core\Usecase\Category;

use PHPSpec2\ObjectBehavior;

class Add extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Category\Add\Repository $category_add
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($category, $category_add, $validator)
    {
        $data = array(
            'category' => $category
        );

        $repositories = array(
            'category_add' => $category_add
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Add');
    }

    function it_should_fetch_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Category\Add\Interactor');
    }
}
