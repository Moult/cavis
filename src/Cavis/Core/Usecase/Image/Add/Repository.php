<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Add;

interface Repository
{
    /**
     * Saves submission data to the repository.
     *
     * Example:
     * $repository->save('Foo', '/path/to/file.png');
     *
     * @return void
     */
    public function save($submission_name, $submission_file);
}
