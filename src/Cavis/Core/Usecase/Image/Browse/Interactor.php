<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Browse;

class Interactor
{
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function interact()
    {
        return $this->repository->get_snapshot_of_latest_images();
    }
}
