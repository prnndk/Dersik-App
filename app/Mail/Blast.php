<?php

namespace App\Mail;

use App\Models\BlastMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Blast extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;
    protected $blast_mail;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BlastMail $blast_mail, User $user)
    {
        $this->blast_mail = $blast_mail;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->blast_mail->subject,
            from: new Address('postmaster@smasa.id', $this->blast_mail->from ? $this->blast_mail->from : 'SMASA BLITAR'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.blasts',
            with: [
                'content' => $this->blast_mail->message,
                'user' => $this->user,
            ],
        );
    }

    public function toMailAttachment(): Attachment
    {
        return Attachment::fromPath($this->blast_mail->attachment);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if ($this->blast_mail->attachment) {
            return [Attachment::fromStorage($this->blast_mail->attachment)];
        }
    }
}
