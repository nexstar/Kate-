<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class ToMyselfEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $array;

    public function __construct($phones,$names,$contents)
    {

        $this->array = [
			'phones'  => $phones,
            'names'   => $names,
			'content' => $contents,
		];

    }

    public function handle()
    {

		Mail::send('email.tomyselfemail', $this->array, function($message) {
            $message->from(env('MAIL_USERNAME'), env('MAIL_SEND_USER'));
            $message->to(env('MAIL_USERNAME'))->subject('已完成簡訊指定客戶發送');
        });

    }
}
