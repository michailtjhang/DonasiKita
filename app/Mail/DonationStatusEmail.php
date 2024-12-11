<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $donorName;

    /**
     * Create a new message instance.
     *
     * @param  string  $status
     * @param  string  $donorName
     * @return void
     */
    public function __construct($status, $donorName)
    {
        $this->status = $status;
        $this->donorName = $donorName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.donation-status')
            ->subject($this->status === 'approved' ? 'Donasi Anda Diterima' : 'Donasi Anda Ditolak')
            ->with([
                'status' => $this->status,
                'donorName' => $this->donorName,
            ]);
    }
}
