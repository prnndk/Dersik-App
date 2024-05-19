<?php

namespace App\Livewire;

use App\Models\kelas;
use App\Models\RegisProm;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegisterProm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $is_join;
    public $class;

    public function create()
    {
        $this->validate([
            'name' => 'required|min:4|unique:regis_proms,nama|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email:dns|unique:regis_proms,email',
            'phone' => 'required|min:10',
            'is_join' => 'required|boolean',
            'class' => 'required',
        ]);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_join' => $this->is_join,
            'class' => $this->class,
        ];
        $this->resetInput();
        $this->dispatch('registerPromStore', $data);
    }

    public function registerPromStore($data)
    {
        $store_data = [
            'nama' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['phone'],
            'kesediaan' => $data['is_join'],
            'kelas_id' => $data['class'],
            'user_id' => auth()->user()->id,
        ];
        DB::beginTransaction();
        try {
            RegisProm::create($store_data);
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', $e->getMessage());
        }
        DB::commit();
        session()->flash('success', 'Register successfully');
    }

    public function render()
    {
        return view('livewire.register-prom', [
            'kelas' => kelas::all(),
        ]);
    }
}
