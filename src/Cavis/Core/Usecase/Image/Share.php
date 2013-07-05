<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image;
use Cavis\Core\Usecase\Image\Share\Interactor;
use Cavis\Core\Usecase\Image\Share\Recipient;

class Share
{
    private $data;
    private $tools;

    public function __construct(Array $data, Array $tools)
    {
        $this->data = $data;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->data['image'],
            $this->get_recipient()
        );
    }

    private function get_recipient()
    {
        return new Recipient(
            $this->data['user'],
            $this->tools['emailer'],
            $this->tools['formatter'],
            $this->tools['validator']
        );
    }
}
