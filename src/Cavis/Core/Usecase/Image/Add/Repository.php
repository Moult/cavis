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
     * @param string $submission_name The name of the image submission
     * @param string $submission_file The path to the image submission file
     *
     * @return int The unique id of the saved image
     */
    public function save_image($submission_name, $submission_file);

    /**
     * Saves a file.
     *
     * Automatically adds a unique file prefix.
     *
     * Example:
     * $repository->save_file($file);
     *
     * @param Data\File $file The file data to save
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
     * @param string $file_path The path to the generated file.
     *
     * @return void
     */
    public function save_generated_file($file_path);
}
