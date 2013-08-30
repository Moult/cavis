<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category\Add;
use Cavis\Core\Data;
use Cavis\Core\Tool;
use Cavis\Core\Exception;

class Submission extends Data\Category
{
    public $name;
    public $parent;
    private $repository;
    private $validator;

    public function __construct(Data\Category $category, Repository $repository, Tool\Validator $validator)
    {
        $this->name = $category->name;
        $this->parent = $category->parent;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'parent' => $this->parent
        ));
        $this->validator->rule('name', 'not_empty');
        $this->validator->callback('parent', array($this, 'is_an_existing_category_id'), array('parent'));

        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_an_existing_category_id($id)
    {
        if ($id !== NULL)
            return $this->repository->does_category_exist($id);
        else
            return TRUE;
    }

    public function submit()
    {
        $this->repository->add_new_category($this->name, $this->parent);
    }
}
