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

    function it_should_have_an_author()
    {
        $this->author->shouldBe(NULL);
    }

    function it_should_have_a_website()
    {
        $this->website->shouldBe(NULL);
    }

    function it_should_have_an_email()
    {
        $this->email->shouldBe(NULL);
    }

    function it_should_have_a_summary()
    {
        $this->summary->shouldBe(NULL);
    }

    function it_should_have_a_description()
    {
        $this->description->shouldBe(NULL);
    }

    function it_should_have_a_thumbnail()
    {
        $this->thumbnail->shouldBe(NULL);
    }

    function it_should_have_file_data()
    {
        $this->file->shouldBe(NULL);
    }

    function it_should_have_supplementary_files()
    {
        $this->supplementary_files->shouldBe(NULL);
    }

    function it_should_have_comments()
    {
        $this->comments->shouldBe(NULL);
    }

    function it_should_have_a_number_of_votes()
    {
        $this->number_of_votes->shouldBe(NULL);
    }

    function it_should_belong_to_a_category()
    {
        $this->category->shouldBe(NULL);
    }
}
