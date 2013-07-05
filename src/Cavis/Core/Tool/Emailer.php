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
     * @param string $to_address   The email address to send to.
     * @param string $from_address The email address to send from
     * @param string $subject      Subject of the email to send
     * @param string $message      Plain text email body
     *
     * @return void
     */
    public function send($to_address, $from_address, $subject, $message);
}
