<?php

namespace spec\Cavis\Core\Usecase\Image\Add;

use PHPSpec2\ObjectBehavior;

class Submission extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Tool\Validation $validation
     */
    function let($image, $validation)
    {
        $image->name = 'Foo';
        $image->file = 'file';
        $this->beConstructedWith($image, $validation);
        $this->name->shouldBe('Foo');
        $this->file->shouldBe('file');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Add\Submission');
    }

    function it_should_be_an_image()
    {
        $this->shouldHaveType('Cavis\Core\Data\Image');
    }

    function it_should_validate_the_submission($validation)
    {
        $validation->setup(array(
            'name' => 'Foo',
            'file' => 'file',
        ))->shouldBeCalled();
        $validation->rule('name', 'not_empty')->shouldBeCalled();
        $validation->rule('name', 'max_length', 30)->shouldBeCalled();
        $validation->rule('file', 'upload_valid')->shouldBeCalled();
        $validation->rule('file', 'upload_type', array('jpg', 'png', 'jpeg'))->shouldBeCalled();
        $validation->rule('file', 'upload_size', '1M')->shouldBeCalled();
        $validation->check()->shouldBeCalled()->willReturn(TRUE);
        $this->validate();
    }

    function it_should_throw_an_error_at_invalid_submissions($validation)
    {
        $validation->check()->shouldBeCalled()->willReturn(FALSE);
        $validation->errors()->shouldBeCalled()->willReturn(array('name', 'file'));
        $this->shouldThrow('Cavis\Core\Exception\Validation')
            ->duringValidate();
    }
}
