<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category\Add;

class Interactor
{
    private $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->submission->validate();
        $this->submission->submit();
    }
}
