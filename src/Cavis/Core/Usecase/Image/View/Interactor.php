<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\View;
use Cavis\Core\Data;

class Interactor
{
    public function __construct(Data\Image $image, Repository $repository)
    {
        $this->image = $image;
        $this->repository = $repository;
    }

    public function interact()
    {
        return $this->repository->get_all_image_data($this->image->id);
    }
}
