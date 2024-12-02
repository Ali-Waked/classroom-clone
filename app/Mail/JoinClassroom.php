<?php

namespace App\Mail;

use App\Models\Classroom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JoinClassroom extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Classroom $classroom)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation For Joining Classroom',
            from: new Address($this->classroom->user->email, $this->classroom->user->name),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'send.invitation.classroom.email',
            // view: 'view.name',
            with: [
                'url' => $this->classroom->join_teacher_link,
                'button' => __('Accept the invitation'),
                'content' => __('I recevied an invitation from this teacher :teacher to help teach the #:classroom', [
                    'teacher' => $this->classroom->user->name,
                    'classroom' => $this->classroom->name,
                ]),

            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath($this->classroom->user->avatar_logo),
        ];
    }
}
