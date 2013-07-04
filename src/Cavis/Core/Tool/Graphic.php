<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Tool;

interface Graphic
{
    /**
     * Returns image width in pixels
     *
     * Example:
     * $image->get_width('/path/to/file.jpg');
     */
    public function get_width($file_path);
}
