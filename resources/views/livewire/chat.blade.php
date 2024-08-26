<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Member') }}</div>

                    <div class="card-body">
                        @foreach ($semuapengguna as $pengguna)
                            <button class="btn btn-outline-primary w-100 mb-1" wire:click='pilihMember("{{ $pengguna->id }}")'>{{ $pengguna->name }}
                            @if ($hitung = App\Models\Semuaobrolan::where('tujuan', Auth::id())->where('dari', $pengguna->id)->where('sudahbaca', 0)->count())
                            <span class="text-danger">{{ $hitung }}</span>
                            @endif
                            </button>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8"wire:poll>
                @if($orangpilih)
                    <div class="card">
                    <div class="card-header">Obrolan dengan {{ $orangpilih->name }}</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            @foreach ($semuapercakapan as $sp )
                            <tr align="@if ($sp->dari == Auth::id()) right @else left @endif">
                                <td>{{ $sp->pesan }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <input type="text" class="form-control" wire:model='isipesan'>
                        <button class="btn btn-primary" wire:click='simpan'>kirim</button>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
