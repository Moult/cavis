<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category\Add;

interface Repository
{
    public function add_new_category($name, $parent_id);
}
