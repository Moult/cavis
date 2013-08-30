<?php

namespace Cavis\Core\Usecase\Category;

use Cavis\Core\Usecase\Category\Delete\Interactor;

class Delete
{
    private $data;
    private $repositories;

    public function __construct(array $data, array $repositories)
    {
        $this->data = $data;
        $this->repositories = $repositories;
    }

    public function fetch()
    {
        return new Interactor(
            $this->data['category'],
            $this->repositories['category_delete']
        );
    }
}
