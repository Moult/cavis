<?php

namespace spec\Cavis\Core\Usecase\Category\Add;

use PHPSpec2\ObjectBehavior;

class Submission extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Category\Add\Repository $repository
     * @param Cavis\Core\Tool\Validator $validator
     * @param Cavis\Core\Data\Category $parent
     */
    function let($category, $repository, $validator, $parent)
    {
        $parent->id = 'parent_id';
        $category->name = 'name';
        $category->parent = $parent;
        $this->beConstructedWith($category, $repository, $validator);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Category\Add\Submission');
    }

    function it_should_be_a_category()
    {
        $this->shouldHaveType('Cavis\Core\Data\Category');
    }

    function it_can_validate($validator)
    {
        $validator->setup(array(
            'name' => 'name',
            'parent_id' => 'parent_id'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->callback('parent_id', array($this, 'is_an_existing_category_id'), array('parent_id'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('name', 'parent'));
        $this->shouldThrow('Cavis\Core\Exception\Validation')->duringValidate();
    }

    function it_checks_whether_or_not_something_is_an_existing_category_id($repository)
    {
        $repository->does_category_exist('id')->shouldBeCalled()->willReturn(FALSE);
        $this->is_an_existing_category_id('id')->shouldReturn(FALSE);
    }

    function it_does_not_check_existing_categories_for_null_parents($repository)
    {
        $repository->does_category_exist(NULL)->shouldNotBeCalled();
        $this->is_an_existing_category_id(NULL)->shouldReturn(TRUE);
    }

    function it_can_submit_the_category($repository)
    {
        $repository->add_new_category('name', 'parent_id')->shouldBeCalled();
        $this->submit();
    }
}
