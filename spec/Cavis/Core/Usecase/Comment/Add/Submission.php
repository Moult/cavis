<?php

namespace spec\Cavis\Core\Usecase\Comment\Add;

use PHPSpec2\ObjectBehavior;

class Submission extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Comment $comment
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Usecase\Comment\Add\Repository $repository
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($comment, $image, $repository, $validator)
    {
        $comment->message = 'Foo';
        $image->id = 42;
        $comment->image = $image;
        $this->beConstructedWith($comment, $repository, $validator);
        $this->message->shouldBe('Foo');
        $this->image->shouldBe($image);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Comment\Add\Submission');
    }

    function it_should_be_a_comment()
    {
        $this->shouldHaveType('Cavis\Core\Data\Comment');
    }

    function it_can_validate($validator)
    {
        $validator->setup(array(
            'message' => 'Foo',
            'image_id' => 42
        ))->shouldBeCalled();
        $validator->rule('message', 'not_empty')->shouldBeCalled();
        $validator->callback('image_id', array($this, 'is_existing_image'), array('image_id'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(TRUE);
        $this->validate();
    }

    function it_checks_for_existing_images($repository)
    {
        $repository->check_image_exists(42)->shouldBeCalled()->willReturn(TRUE);
        $this->is_existing_image(42)->shouldreturn(TRUE);
    }

    function it_invalidates_empty_messages($validator)
    {
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('message'));
        $this->shouldThrow('Cavis\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_can_submit_the_comment($repository)
    {
        $repository->save_comment('Foo', 42)->shouldBeCalled();
        $this->submit();
    }
}
