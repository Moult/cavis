<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Cavis\Core\Usecase\Image\Share;
use Cavis\Core\Data;
use Cavis\Core\Tool;
use Cavis\Core\Exception;

class Recipient extends Data\User
{
    public function __construct(Data\User $user, Tool\Emailer $emailer, Tool\Formatter $formatter, Tool\Validator $validator)
    {
        $this->email = $user->email;
        $this->emailer = $emailer;
        $this->formatter = $formatter;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'email' => $this->email
        ));
        $this->validator->rule('email', 'email');
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function notify(Data\Image $image)
    {
        $this->formatter->setup($image);
        $this->emailer->send($this->email, 'noreply@thinkmoult.com', 'Image recommendation', $this->formatter->format('Email_Share'));
    }
}
