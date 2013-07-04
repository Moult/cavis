<?php

namespace spec\Cavis\Core\Usecase\Image\Add;

use PHPSpec2\ObjectBehavior;

class Submission extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Data\File $file
     * @param Cavis\Core\Usecase\Image\Add\Repository $repository
     * @param Cavis\Core\Tool\Graphic $graphic
     * @param Cavis\Core\Tool\Validation $validation
     */
    function let($image, $file, $repository, $graphic, $validation)
    {
        $file->tmp_name = 'tmp_Foo';
        $image->name = 'Foo';
        $image->file = $file;
        $this->beConstructedWith($image, $repository, $graphic, $validation);
        $this->name->shouldBe('Foo');
        $this->file->shouldBe($file);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Add\Submission');
    }

    function it_should_be_an_image()
    {
        $this->shouldHaveType('Cavis\Core\Data\Image');
    }

    function it_should_validate_the_submission($file, $validation)
    {
        $validation->setup(array(
            'name' => 'Foo',
            'file' => $file,
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

    function it_checks_whether_or_not_the_image_is_wider_than_the_layout($graphic)
    {
        $graphic->get_width('tmp_Foo')->shouldBeCalled()->willReturn(474);
        $this->is_wider_than_layout()->shouldReturn(FALSE);
    }

    function it_checks_if_the_image_is_thinner_than_the_layout($graphic)
    {
        $graphic->get_width('tmp_Foo')->shouldBeCalled()->willReturn(475);
        $this->is_wider_than_layout()->shouldReturn(TRUE);
    }

    function it_can_resize_image_to_layout_width($graphic)
    {
        $graphic->resize_to_width('tmp_Foo', 474)->shouldBeCalled();
        $this->resize_to_layout();
    }

    function it_can_generate_a_blurred_image_background($graphic)
    {
        $graphic->blur('tmp_Foo', 978, 'tmp_Foo.blur')->shouldBeCalled();
        $this->generate_background();
    }

    function it_generates_a_cropped_thumbnail($graphic)
    {
        $graphic->crop_thumbnail('tmp_Foo', 222, 'tmp_Foo.thumb')->shouldBeCalled();
        $this->generate_cropped_thumbnail();
    }

    function it_submits_the_proposal($file, $repository)
    {
        $repository->save_file($file)->shouldBeCalled()->willReturn('/path/to/upload/file.png');
        $repository->save_generated_file('tmp_Foo.blur')->shouldBeCalled();
        $repository->save_generated_file('tmp_Foo.thumb')->shouldBeCalled();
        $repository->save_record('Foo', '/path/to/upload/file.png')->shouldBeCalled()->willReturn(42);
        $this->submit()->shouldReturn(42);
    }
}
