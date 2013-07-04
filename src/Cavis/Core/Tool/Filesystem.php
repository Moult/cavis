<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Tool;
use Cavis\Core\Data;

interface Filesystem
{
    /**
     * Saves an uploaded file to a specific location.
     *
     * Automatically adds a unique file prefix.
     *
     * Example:
     * $upload->save_upload($file);
     *
     * @return mixed string bool full path to uploaded file or FALSE if failed
     */
    public function save_upload(Data\File $file);

    /**
     * Moves a file from one location to another.
     *
     * Example:
     * $upload->move('/tmp/foo', '/home/user/foo.ext');
     *
     * @return void
     */
    public function move($source, $destination);
}
