<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Browse;

interface Repository
{
    /**
     * Gets a preview view of all the latest submitted images
     *
     * Example:
     * $images = $repository->get_snapshot_of_latest_images();
     * $latest_submission_comments = $images[0]->comments;
     * $third_most_popular_comment = $latest_submission_comments[2];
     *
     * @return Array of Cavis\Core\Data\Image, with up to three most popular
     * comments shown
     */
    public function get_snapshot_of_latest_images();
}
