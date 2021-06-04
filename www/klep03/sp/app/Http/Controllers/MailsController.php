<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailsController extends Controller
{
    public function sendMail() {
        $details = [
            'title'     => 'mail Title',
            'body'      => 'Hello, thank you for registration',
        ];
        Mail::to("klepetkope@gmail.com")->send(new MailSender($details));
        return 'Email-sent';
    }

    public function sendEmailConfirmation($email, $activationCode) {
        $details = [
            'title'             => 'Hello,',
            'body'              => 'Thank you for registration. Please complete your registration by confirming your e-mail address with this code: ',
            'activationCode'    => $activationCode,
        ]; 
        Mail::to($email)->send(new MailSender($details));
    }
}
