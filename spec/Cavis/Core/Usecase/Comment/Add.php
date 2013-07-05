<?php

namespace spec\Cavis\Core\Usecase\Comment;

use PHPSpec2\ObjectBehavior;

class Add extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Comment $comment
     * @param Cavis\Core\Usecase\Comment\Add\Repository $comment_add
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($comment, $comment_add, $validator)
    {
        $data = array(
            'comment' => $comment
        );

        $repositories = array(
            'comment_add' => $comment_add
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Comment\Add');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Cavis\Core\Usecase\Comment\Add\Interactor');
    }
}
