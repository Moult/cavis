<?php

namespace spec\Cavis\Core\Data;

use PHPSpec2\ObjectBehavior;

class Comment extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Data\Comment');
    }

    function it_should_have_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_should_have_a_message()
    {
        $this->message->shouldBe(NULL);
    }

    function it_should_have_a_vote_count()
    {
        $this->number_of_votes->shouldBe(NULL);
    }
}
