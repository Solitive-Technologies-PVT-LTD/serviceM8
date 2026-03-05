<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $loginUrl;

    public function __construct($email, $password, $loginUrl)
    {
        $this->email = $email;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
    }

    public function build()
    {
        return $this->subject('Your Portal Account Details')
                    ->view('emails.user_created')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                        'loginUrl' => $this->loginUrl,
                    ]);
    }
}