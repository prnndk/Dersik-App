    {{-- Care about people's approval and you will be their prisoner. --}}

<div class="section-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Mail Blasting History</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Make New Blast Mail</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        {{-- title area --}}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" wire:model="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject of email">
                            @error('subject')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- markdown area  --}}
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="hidden" id="message" wire:model="message">
                            <div id="editor" wire:ignore></div>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="attachment_type">Tipe Attachment</label>
                            <select name="attachment_type" id="attachment_type" class="form-control select2 @error('attachment') is-invalid @enderror">
                                <option value="" disabled selected>-Pilih tipe attachment-</option>
                                <option value="none">Tidak ada</option>
                                <option value="pdf">PDF</option>
                                <option value="picture">Gambar</option>
                            </select>
                            @error('attachment_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{-- file upload attachment --}}
                            <label for="attachment">Attachment</label>
                            <input type="file" wire:model="attachment" class="form-control @error('attachment') is-invalid @enderror" id="attachment">
                            @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sender">Customize Sender Name (Default is postmaster@smasa.id)</label>
                            <input type="text" wire:model="sender" class="form-control @error('sender') is-invalid @enderror" id="sender" placeholder="Sender Name">
                            @error('sender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="type">Type Blasting</label>
                            <select name="type" id="type" class="form-control select2 @error('type') is-invalid @enderror">
                                <option value="" disabled selected>-Pilih tipe blasting-</option>
                                <option value="informasi">Informasi</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="undangan">Undangan</option>
                                <option value="broadcast">Broadcast</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="receiver">Penerima</label>
                            <select name="receiver" id="receiver" class="form-control select2">
                                <option value="" disabled selected>-Pilih penerima-</option>
                                <option value="all">Semua</option>
                                @foreach ($kelas as $kelasItem)
                                <option value="kelas_{{ $kelasItem->id }}">Only Kelas {{ $kelasItem->kelas.$kelasItem->angkatan->nama }}</option>
                                @endforeach
                                @foreach ($angkatan as $angkatanItem)
                                    <option value="angkatan_{{ $angkatanItem->id }}">Only Angkatan {{ $angkatanItem->nama .'/'. $angkatanItem->tahun }}</option>
                                @endforeach
                            </select>
                            @error('receiver')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- button --}}
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        const editor = new toastui.Editor(
            {
                el: document.querySelector('#editor'),
                height: '500px',
                initialEditType: 'markdown',
                previewStyle: 'tab',
                usageStatistics:false,
            }
        )
        editor.on('change', function(){
            const content = editor.getMarkdown();
            @this.set('message',content)
        })
        $("#attachment_type").on('change',function(e){
            let value = $(this).val();
            @this.set('attachment_type',value);
        })
        $("#receiver").on('change',function(e){
            let value = $(this).val();
            @this.set('receiver',value);
        })
        $("#type").on('change',function(e){
            let value = $(this).val();
            @this.set('type',value);
        })
    </script>
@endpush
