<?php

namespace spec\Cavis\Core\Usecase\Comment\Delete;

use PHPSpec2\ObjectBehavior;

class Interactor extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Comment $comment
     * @param Cavis\Core\Usecase\Comment\Delete\Repository $repository
     */
    function let($comment, $repository)
    {
        $comment->id = 42;
        $this->beConstructedWith($comment, $repository);
        $this->comment->shouldBe($comment);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Comment\Delete\Interactor');
    }

    function it_carries_out_the_interaction_chain($repository)
    {
        $repository->delete_comment(42)->shouldBeCalled();
        $this->interact();
    }
}
