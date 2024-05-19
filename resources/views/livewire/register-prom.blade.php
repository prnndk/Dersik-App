<div>
    {{-- In work, do what you enjoy. --}}
        <form wire:submit="create">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required value="{{ old('name') }}" wire:model.live="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Active Mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email') }}" wire:model.live="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for='kelas'>Kelas</label>
                <select class="form-control selectric" name='kelas_id' wire:model.live="class">
                    @foreach ($kelas as $list)
                        @if (old('kelas_id')==$list->id)
                            <option value="{{ $list->id }}" selected>{{ $list->kelas }}</option>
                        @else
                            <option value="{{ $list->id }}">{{ $list->kelas }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Hp Aktif</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{old('phone') }}" wire:model.live="phone">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="is_join" class="d-block">Kesediaan Ikut Prom</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="is_join_true" name="is_join_true" class="custom-control-input" wire:model.live="is_join" value="1" {{old('is_join'==1? 'checked':'')}}>
                    <label class="custom-control-label" for="is_join_true">Mengikuti Prom</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="is_join_false" name="is_join_false" class="custom-control-input" wire:model.live="is_join" value="0" {{old('is_join'==0? 'checked':'')}}>
                    <label class="custom-control-label" for="is_join_false">Tidak Mengikuti Prom</label>
                </div>
                @error('is_join')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kedinasan" class="d-block">Apakah anda mengikuti kedinasan?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kedinasan" value="Ikut" id="kedinasan" {{ old('kedinasan')=='Ikut' ? 'checked':''}}>
                    <label class="form-check-label" for="iya">
                        Mengikuti Kedinasan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kedinasan" value="Tidak" id="kedinasan" {{ old('kedinasan')=='Tidak' ? 'checked':'' }}>
                    <label class="form-check-label" for="Tidak">
                        Tidak Mengikuti Kedinasan
                    </label>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Ujian Kedinasan</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal"value="{{ old('tanggal') }}">
                    @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
</div>
