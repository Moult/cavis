<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Vote;

interface Repository
{
    /**
     * Checks whether or not a vote already exists.
     *
     * Example:
     * $repository->has_existing_vote('127.0.0.1', 42);
     *
     * @param string $ip         The ip address of the voter
     * @param int    $comment_id The unique ID associated with the comment
     *
     * @return bool TRUE if vote exists, else FALSE
     */
    public function has_existing_vote($ip, $image_id);

    /**
     * Saves a vote record in the database.
     *
     * Example:
     * $repository->has_existing_vote('127.0.0.1', 42);
     *
     * @param string $ip         The ip address of the voter
     * @param int    $comment_id The unique ID associated with the comment
     *
     * @return void
     */
    public function save_vote($ip, $image_id);
}
