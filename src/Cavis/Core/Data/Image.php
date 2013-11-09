<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Data;

class Image
{
    public $id;
    public $name;
    /**
     * @var Data\File
     */
    public $thumbnail;
    /**
     * @var Data\File
     */
    public $file;
    public $comments;
    public $number_of_votes;
    /**
     * @var Data\Category
     */
    public $category;
}
