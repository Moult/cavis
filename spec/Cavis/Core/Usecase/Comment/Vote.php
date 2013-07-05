<?php

namespace spec\Cavis\Core\Usecase\Comment;

use PHPSpec2\ObjectBehavior;

class Vote extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\User $user
     * @param Cavis\Core\Data\Comment $comment
     * @param Cavis\Core\Usecase\Comment\Vote\Repository $comment_vote
     */
    function let($user, $comment, $comment_vote)
    {
        $data = array(
            'user' => $user,
            'comment' => $comment
        );

        $repositories = array(
            'comment_vote' => $comment_vote
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Comment\Vote');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Comment\Vote\Interactor');
    }
}
