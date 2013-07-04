<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Delete;
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
        $this->repository->delete($this->image->id);
    }
}
