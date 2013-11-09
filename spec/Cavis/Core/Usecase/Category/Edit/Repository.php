<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Category\Edit;

interface Repository
{
    public function update_category($id, $name, $parent_id);
}
