<?php

namespace spec\Cavis\Core\Usecase\Comment;

use PHPSpec2\ObjectBehavior;

class Delete extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Comment $comment
     * @param Cavis\Core\Usecase\Comment\Delete\Repository $comment_delete
     */
    function let($comment, $comment_delete)
    {
        $data = array(
            'comment' => $comment
        );

        $repositories = array(
            'comment_delete' => $comment_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Comment\Delete');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Comment\Delete\Interactor');
    }
}
