<?php

namespace App\Mail;

use App\Models\siswa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendataanMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;
    public function __construct(siswa $siswa)
    {
        $this->data=$siswa;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Response Pendataan DERSIK 22',
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
            markdown: 'emails.pendataan.response',
            with:[
                'nama'=>$this->data->nama,
                'kelas'=>$this->data->kls->kelas,
                'status'=>$this->data->sttus->nama,
                'instansi'=>$this->data->instansi,
                'detail'=>$this->data->detail_status,
                'nomor'=>$this->data->nomor,
                'domisili'=>$this->data->kab->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
