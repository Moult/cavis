<?php

namespace spec\Cavis\Core\Data;

use PHPSpec2\ObjectBehavior;

class Category extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Data\Category');
    }

    function it_has_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_has_a_name()
    {
        $this->name->shouldBe(NULL);
    }

    function it_has_a_parent()
    {
        $this->parent->shouldBe(NULL);
    }
}
