<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Semuaobrolan;

class Chat extends Component
{
    public $orangpilih;
    public $isipesan;
    public $semuapercakapan;

    public function pilihMember($idmember)
    {
        $this->orangpilih = User::find($idmember);
        Semuaobrolan::where('tujuan', Auth::id())->update([
            'sudahbaca' => 1
        ]);
    }

    public function simpan()
    {
        $simpan = new Semuaobrolan();
        $simpan->dari = Auth::id();
        $simpan->tujuan = $this->orangpilih->id;
        $simpan->pesan = $this->isipesan;
        $simpan->sudahbaca = 0;
        $simpan->save();
    }

    public function render()
    {
        if($this->orangpilih){
            $this->semuapercakapan = Semuaobrolan::where(function ($q){
                $q->where('dari', Auth::id())->where('tujuan', $this->orangpilih->id);
            })->orWhere(function ($q) {
                $q->where('dari',  $this->orangpilih->id)->where('tujuan', Auth::id());
            })->get();
        }
        $semuapengguna = User::all()->except(Auth::id());
        return view('livewire.chat')->with([
            'semuapengguna' => $semuapengguna,
            'semuapercakapan' => $this->semuapercakapan
        ]);
    }
}
