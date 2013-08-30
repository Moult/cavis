<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category\Delete;
use Cavis\Core\Data;

class Interactor
{
    private $category;
    private $repository;

    public function __construct(Data\Category $category, Repository $repository)
    {
        $this->category = $category;
        $this->repository = $repository;
    }

    public function interact()
    {
        $this->repository->delete_category($this->category->id);
    }
}
