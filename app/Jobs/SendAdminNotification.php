<?php

namespace App\Jobs;

use App\Mail\AdminNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdminNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $note;

    public function __construct($note)
    {
        $this->note = $note;
    }

    public function handle()
    {
        $adminEmail = 'admin@example.com';
        Mail::to($adminEmail)->send(new AdminNotification($this->note));
    }
}
