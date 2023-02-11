<?php

namespace App\Mail\Users\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build(): self
    {
        return $this->from('sender@example.com')
            ->subject('Recover Password Email')
            ->view('mails.restore_password')
            ->with('data', $this->data);
    }
}
