<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Add;
use Cavis\Core\Data;

interface Repository
{
    /**
     * Saves submission data to the repository.
     *
     * Example:
     * $repository->save('Foo', '/path/to/file.png');
     *
     * @return int The unique id of the saved record
     */
    public function save_record($submission_name, $submission_file);

    /**
     * Saves a file.
     *
     * Automatically adds a unique file prefix.
     *
     * Example:
     * $repository->save_file($file);
     *
     * @return mixed string bool full path to uploaded file or FALSE if failed
     */
    public function save_file(Data\File $file);

    /**
     * Saves a generated file.
     *
     * Example:
     * $repository->save_generated_file('/path/to/file.png');
     *
     * @return void
     */
    public function save_generated_file($file_path);
}
