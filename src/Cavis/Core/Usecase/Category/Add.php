<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category;
use Cavis\Core\Usecase\Category\Add\Interactor;
use Cavis\Core\Usecase\Category\Add\Submission;

class Add
{
    private $data;
    private $repositories;
    private $tools;

    public function __construct(array $data, array $repositories, array $tools)
    {
        $this->data = $data;
        $this->repositories = $repositories;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->get_submission()
        );
    }

    public function get_submission()
    {
        return new Submission(
            $this->data['category'],
            $this->repositories['category_add'],
            $this->tools['validator']
        );
    }
}
