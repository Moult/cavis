<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Tool;

interface Formatter
{
    /**
     * Sets up the formatter with data to use
     *
     * Example:
     * $data = Cavis\Core\Data\User;
     * $formatter->setup($data);
     *
     * @return void
     */
    public function setup($data);

    /**
     * Formats the data in the template specified
     *
     * Example:
     * $formatter->format('Email_Notification');
     *
     * @return void
     */
    public function format($template);
}
