<?php

namespace App\Http\Livewire;

use App\Http\Controllers\BlastMailController;
use App\Models\Angkatan;
use App\Models\kelas;
use Livewire\Component;
use Livewire\WithFileUploads;

class Mailblast extends Component
{
    use WithFileUploads;
    public $title;
    public $subject;
    public $message;
    public $attachment_type;
    public $attachment;
    public $status;
    public $type;
    public $sender;
    public $receiver;

    public function save()
    {
        $cek = $this->validate([
            'title' => 'required|string|min:5|max:150',
            'subject' => 'required|string|min:5|max:150',
            'message' => 'required',
            'attachment_type' => 'required',
            'attachment' => 'required_if:attachment_type,[pdf,picture]|file|mimes:png,jpg,svg,pdf|nullable',
            'type' => 'required',
            'sender' => 'string|nullable|max:150',
            'receiver' => 'required',
        ]);

        if ($this->attachment) {
            $store = $this->attachment->store('attachment');
        } else {
            $store = null;
        }
        $data = [
            'title' => $this->title,
            'subject' => $this->subject,
            'message' => $this->message,
            'attachment_type' => $this->attachment_type,
            'attachment' => $store,
            'status' => $this->status,
            'type' => $this->type,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
        ];
        try {
            BlastMailController::store($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function execute()
    {
        if ($this->attachment) {
            $store = $this->attachment->store('public/attachment');
        } else {
            $store = null;
        }
        $data = [
            'title' => $this->title,
            'subject' => $this->subject,
            'message' => $this->message,
            'attachment_type' => $this->attachment_type,
            'attachment' => $store,
            'status' => $this->status,
            'type' => $this->type,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
        ];
        try {
            BlastMailController::store($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        return view('livewire.mailblast', [
            'angkatan' => Angkatan::all(),
            'kelas' => kelas::all(),
        ]);
    }
}
