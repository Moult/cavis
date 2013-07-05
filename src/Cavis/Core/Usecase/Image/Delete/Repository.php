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
     * @param int $image_id The unique ID associated with the image
     *
     * @return void
     */
    public function delete($image_id);
}
