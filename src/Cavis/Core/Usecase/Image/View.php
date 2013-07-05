<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image;
use Cavis\Core\Usecase\Image\View\Interactor;

class View
{
    private $data;
    private $repositories;

    public function __construct(Array $data, Array $repositories)
    {
        $this->data = $data;
        $this->repositories = $repositories;
    }

    public function fetch()
    {
        return new Interactor(
            $this->data['image'],
            $this->repositories['image_view']
        );
    }
}
