<?php

namespace spec\Cavis\Core\Data;

use PHPSpec2\ObjectBehavior;

class User extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Data\User');
    }

    function it_should_have_an_ip()
    {
        $this->ip->shouldBe(NULL);
    }

    function it_should_have_an_email()
    {
        $this->email->shouldBe(NULL);
    }
}
