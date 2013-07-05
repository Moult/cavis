<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image;
use Cavis\Core\Usecase\Image\Browse\Interactor;

class Browse
{
    private $repositories;

    public function __construct(Array $repositories)
    {
        $this->repositories = $repositories;
    }

    public function fetch()
    {
        return new Interactor(
            $this->repositories['image_browse']
        );
    }
}
