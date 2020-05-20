<?php

namespace App\Http\System\User\Listeners;

use App\Http\System\User\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->sendEmail($event->user);
    }

    protected function sendEmail($user)
    {
        Mail::send('emails.system.user.welcome', [
            'user' => $user
        ], function ($message) use ($user){
            $message->from('no-reply@cmatik.cl', 'ERM - CMATIK');
            $message->to($user->email, $user->first_name.' '.$user->last_name);
            $message->subject("Acceso a nuestro sistema.");
        });
    }
}
