<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    /**
     * Create a new message instance.
     *
     * @param EventRegistration $registration
     */
    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = $this->registration->event;
        $detail = $event->detailEvent;

        $description = $this->registration->status === 'peserta'
            ? $detail->description_participants
            : $detail->description_volunteers;

        return $this->subject('Pendaftaran Event Berhasil')
            ->view('front.emails.event_registration')
            ->with([
                'eventTitle' => $event->title,
                'registrationId' => $this->registration->registration_id,
                'status' => $this->registration->status,
                'description' => $description,
            ]);
    }
}
