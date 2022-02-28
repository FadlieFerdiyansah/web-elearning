<x-app-layouts title="Upload Materi">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <style>
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #e4e6fc;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e4e6fc;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove,
        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-results__option[aria-selected="true"],
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #6777ef;
            color: #fff;
        }
    </style>
    @endpush
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Materi</h4>
        </div>
        <div class="card-body col-md-8 col-sm">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {!! session('success') !!}
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </div>
            @endif
            <form action="{{ route('materis.update', encrypt($materi->id)) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select name="kelas_id" id="kelas" class="form-control">
                        <option value="{{ $materi->kelas_id }}" class="form-control">
                            {{ $materi->kelas->kd_kelas }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="matkul">Matakuliah</label>
                    <select name="matkul_id" id="matkul" class="form-control">
                        <option value="{{ $materi->matkul_id }}" class="form-control">
                            {{ $materi->matkul->nm_matkul }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" value="{{ $materi->judul }}">
                </div>
                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input type="text" name="pertemuan" class="form-control" id="pertemuan" value="{{ $materi->pertemuan }}">
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="form-control selectric" name="tipe" id="tipe">
                        {{-- <select class="form-control selectric" name="tipe" id="tipe" onchange="selectType(this)"> --}}
                        <option disabled selected>Pilih Tipe</option>
                        <option {{ $materi->tipe == 'pdf' ? 'selected' : '' }} value="pdf">PDF</option>
                        <option {{ $materi->tipe == 'youtube' ? 'selected' : '' }} value="youtube">YouTube</option>
                    </select>
                </div>
                <div class="form-group" id="formLink">
                    <label for="link">Link</label>
                    <input type="text" name="file_or_link" class="form-control" id="link" value="{{ $materi->tipe == 'youtube' ? $materi->file_or_link : '' }}">
                </div>
                <div class="form-group" id="formFile">
                    <label for="file">File</label>
                    <input type="file" name="file_or_link" class="form-control" id="file" value="some">
                    <code>Note: Jika file sama seperti yang diinputkan saat membuat materi, <b>Kosongkan</b> </code>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $materi->deskripsi }}</textarea>
                </div>


                <div class="form-group">
                    <x-button>Simpan</x-button>
                </div>
            </form>
        </div>
    </div>
    @push('lastScripts')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script>
        // let link = document.getElementById('formLink'); 
            // let file = document.getElementById('formFile'); 
            // function selectType(sel)
            // {
            //     if(sel.value == 'pdf'){
            //         link.style.display = "none";
            //         file.style.display = "block";
            //     }else{
            //         file.style.display = "none";
            //         link.style.display = "block";
            //     }
            // }
            $(document).ready(function(){
                if($('#tipe option:selected').val() == 'pdf'){
                    $('#formLink').hide();
                }else{
                    $('#formFile').hide();
                }
                $("#tipe").change(function() {
                    if ($("#tipe option:selected").val() == 'pdf') {
                            $('#formLink').hide();
                            $('#formFile').show();
                        } else {
                            $('#formFile').hide();
                            $('#formLink').show();
                        }
                    });
                });
    </script>
    @endpush
</x-app-layouts>