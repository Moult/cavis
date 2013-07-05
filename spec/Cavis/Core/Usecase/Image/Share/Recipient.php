<?php

namespace spec\Cavis\Core\Usecase\Image\Share;

use PHPSpec2\ObjectBehavior;

class Recipient extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\User $user
     * @param Cavis\Core\Tool\Emailer $emailer
     * @param Cavis\Core\Tool\Formatter $formatter
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($user, $emailer, $formatter, $validator)
    {
        $user->email = 'email';
        $this->beConstructedWith($user, $emailer, $formatter, $validator);
        $this->email->shouldBe('email');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Share\Recipient');
    }

    function it_should_be_a_user()
    {
        $this->shouldHaveType('Cavis\Core\Data\User');
    }

    function it_can_validate_recipient_details($validator)
    {
        $validator->setup(array(
            'email' => 'email'
        ))->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(TRUE);
        $this->validate();
    }

    function it_invalidates_fake_emails($validator)
    {
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('foo'));
        $this->shouldThrow('Cavis\Core\Exception\Validation')
            ->duringValidate();
    }

    /**
     * @param Cavis\Core\Data\Image $image
     */
    function it_can_notify_of_an_image($image, $emailer, $formatter)
    {
        $image->id = 42;
        $formatter->setup($image)->shouldBeCalled();
        $formatter->format('Email_Share')->shouldBeCalled()->willReturn('body');
        $emailer->send('email', 'noreply@thinkmoult.com', 'Image recommendation', 'body')->shouldBeCalled();
        $this->notify($image);
    }
}
