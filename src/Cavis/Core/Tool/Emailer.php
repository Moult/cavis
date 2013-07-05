<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Tool;

interface Emailer
{
    /**
     * Sends an email
     *
     * Example:
     * $emailer->send('foo@bar.com', 'bar@foo.com', 'Foo', 'Bar');
     *
     * @return void
     */
    public function send($to_address, $from_address, $subject, $message);
}
