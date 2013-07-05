<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment\Vote;

interface Repository
{
    /**
     * Checks whether or not a vote already exists.
     *
     * Example:
     * $repository->has_existing_vote('127.0.0.1', 42);
     *
     * @return bool TRUE if vote exists, else FALSE
     */
    public function has_existing_vote($ip, $comment_id);

    /**
     * Saves a vote record in the database.
     *
     * Example:
     * $repository->has_existing_vote('127.0.0.1', 42);
     *
     * @return void
     */
    public function save_vote($ip, $comment_id);
}
