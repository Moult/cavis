<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Add;
use Cavis\Core\Data;

interface Repository
{
    public function does_category_exist($id);

    /**
     * @return int The unique id of the saved image
     */
    public function save_image($name, $thumbnail_path, $file_path, $supplementary_file_paths, $category_id);

    /**
     * @return mixed string bool full path to uploaded file or FALSE if failed
     */
    public function save_file(Data\File $file);
}
