<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Data;

class Category
{
    public $id;
    public $name;
    /**
     * @var Data\Category
     */
    public $parent;
}
