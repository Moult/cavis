<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Delete;

interface Repository
{
    /**
     * Deletes image and all associated resources.
     *
     * Example:
     * $repository->delete(42);
     *
     * @return void
     */
    public function delete($record_id);
}
