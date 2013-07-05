<?php

namespace spec\Cavis\Core\Data;

use PHPSpec2\ObjectBehavior;

class Image extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Data\Image');
    }

    function it_should_have_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_should_have_a_name()
    {
        $this->name->shouldBe(NULL);
    }

    function it_should_have_file_data()
    {
        $this->file->shouldBe(NULL);
    }

    function it_should_have_comments()
    {
        $this->comments->shouldBe(NULL);
    }

    function it_should_have_a_number_of_votes()
    {
        $this->number_of_votes->shouldBe(NULL);
    }
}
