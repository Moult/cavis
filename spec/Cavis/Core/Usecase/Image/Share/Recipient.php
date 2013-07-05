<?php

namespace spec\Cavis\Core\Usecase\Image\Share;

use PHPSpec2\ObjectBehavior;

class Recipient extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Share\Recipient');
    }
}
