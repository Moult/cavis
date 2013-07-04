<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Vote;

class Interactor
{
    public function __construct(Voter $voter)
    {
        $this->voter = $voter;
    }

    public function interact()
    {
        $this->voter->authorise();
        $this->voter->vote();
    }
}
