<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Share;
use Cavis\Core\Data;

class Interactor
{
    private $recipient;

    public function __construct(Data\Image $image, Recipient $recipient)
    {
        $this->image = $image;
        $this->recipient = $recipient;
    }

    public function interact()
    {
        $this->recipient->validate();
        $this->recipient->notify($this->image);
    }
}
