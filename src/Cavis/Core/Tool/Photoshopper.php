<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Tool;

interface Photoshopper
{
    /**
     * Sets the source image to manipulate, and the destination to save the result
     *
     * Example:
     * $photoshopper->setup('/tmp/myfile.png', '/home/user/profile.png');
     *
     * @return void
     */
    public function setup($source, $destination = NULL);

    /**
     * Returns image width in pixels
     *
     * @return int
     */
    public function get_width();

    /**
     * Resizes an image to a width in pixels, maintaining aspect ratio
     *
     * Example:
     * $photoshopper->resize_to_width(40);
     *
     * @return void
     */
    public function resize_to_width($width);

    /**
     * Blurs the image using the Gaussian algorithm
     *
     * Example:
     * $photoshopper->gaussian_blur(2.5);
     *
     * @return void
     */
    public function gaussian_blur($sigma);
}
