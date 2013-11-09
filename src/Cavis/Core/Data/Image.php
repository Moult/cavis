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
    public $author;
    public $website;
    public $email;
    public $summary;
    public $description;
    /**
     * @var Data\File
     */
    public $thumbnail;
    /**
     * @var Data\File
     */
    public $file;
    /**
     * @var array of Data\File
     */
    public $supplementary_files;
    public $comments;
    public $number_of_votes;
    /**
     * @var Data\Category
     */
    public $category;
}
