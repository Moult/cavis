<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment\Add;

interface Repository
{
    /**
     * Saves a comment message associated with an image id.
     *
     * Example:
     * $repository->save_comment('Hello', 42);
     *
     * @return void
     */
    public function save_comment($message, $image_id);

    /**
     * Checks whether or not an image exists
     *
     * @return bool TRUE is image exists, else FALSE
     */
    public function check_image_exists($image_id);
}
