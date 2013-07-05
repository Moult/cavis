<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Comment\Delete;

interface Repository
{
    /**
     * Deletes a comment
     *
     * @param int $comment_id The unique ID associated with the comment
     *
     * @return void
     */
    public function delete_comment($comment_id);
}
