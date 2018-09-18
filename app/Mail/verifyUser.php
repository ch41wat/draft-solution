<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Draft;

class verifyUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $draft;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Draft $draft)
    {
        $this->user = $user; 
        $this->draft = $draft; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('home', compact('draft', $this->draft));
    }
}
