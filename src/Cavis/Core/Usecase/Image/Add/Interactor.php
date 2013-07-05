<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Add;

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
        if ($this->submission->is_wider_than_layout())
        {
            $this->submission->resize_to_layout();
        }
        $this->submission->generate_background();
        $this->submission->generate_thumbnail();
        return $this->submission->submit();
    }
}
