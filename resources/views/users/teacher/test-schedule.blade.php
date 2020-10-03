@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Atur Jadwal Ujian Kelas {{ $levelsubject->level->kelas }}</h1>
                    <h3>Mata Pelajaran {{ $levelsubject->subject->mata_pelajaran }}</h3>
                    </div>
                <div class="col-sm-6">
                    <h5 class="text-right">Semester {{ Year::thisSemester()->semester }}</h5>
                    <h5 class="text-right">Tahun Ajaran {{ Year::thisSemester()->year->awal }}/{{ Year::thisSemester()->year->akhir }}</h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="mt-2 mx-auto">
                                    <table class="table table-responsive" id="table-student">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>URL</th>
                                                    <th>Kategori</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Tengah Semester
                                                    </td>
                                                    <td>
                                                        @if ($urlMidTest)
                                                            <a href="{{$urlMidTest->url}}" target="_blank">
                                                                <strong>Link Ujian</strong>
                                                            </a>
                                                        @else
                                                            <i class="text-danger">URL Ujian Belum Dimasukkan</i> 
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if ($urlMidTest)
                                                            <button 
                                                                class="btn btn-sm btn-success" 
                                                                type="button" 
                                                                data-toggle="modal" 
                                                                data-target="#staticBackdrop"
                                                                onclick="setTestURL(1, 'Tengah Semester', {{$levelsubject->id}}, '{{$urlMidTest->url}}')"
                                                                >
                                                                Ubah Alamat URL
                                                            </button>
                                                        @else
                                                            <button 
                                                                class="btn btn-sm btn-primary" 
                                                                type="button" 
                                                                data-toggle="modal" 
                                                                data-target="#staticBackdrop"
                                                                onclick="setTestURL(0, 'Tengah Semester', {{$levelsubject->id}}, null)"
                                                                >
                                                                Tambah Alamat URL
                                                            </button>
                                                        @endif
                                                    </td>
                                                    

                                                </tr>
                                                <tr>
                                                    <td>
                                                        Akhir Semester
                                                    </td>
                                                    <td>
                                                        @if ($urlLastTest)
                                                            <a href="{{$urlLastTest->url}}" target="_blank">
                                                                <strong>Link Ujian</strong>
                                                            </a>
                                                        @else
                                                            <i class="text-danger">URL Ujian Belum Dimasukkan</i> 
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if ($urlLastTest)
                                                            <button 
                                                                class="btn btn-sm btn-success" 
                                                                type="button" 
                                                                data-toggle="modal" 
                                                                data-target="#staticBackdrop"
                                                                onclick="setTestURL(1, 'Akhir Semester', {{$levelsubject->id}}, '{{$urlLastTest->url}}')"
                                                                >
                                                                Ubah Alamat URL
                                                            </button>
                                                        @else
                                                            <button 
                                                                class="btn btn-sm btn-primary" 
                                                                type="button" 
                                                                data-toggle="modal" 
                                                                data-target="#staticBackdrop"
                                                                onclick="setTestURL(0, 'Akhir Semester', {{$levelsubject->id}}, null)"
                                                                >
                                                                Tambah Alamat URL
                                                            </button>
                                                        @endif

                                                    </td>
                                                    
                                                </tr>
                                            

                                            </tbody>                                
                                    
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

        <!-- Modal -->
        <form action="" method="post" id="form-modal">
            @csrf
            @method('patch')
            <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategori" name="kategori" readonly>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="url" class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="URL">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="submit-modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
 
<script>
    const setTestURL = (origin, kategori, subject, data) => {
        const labelHeader = document.getElementById('staticBackdropLabel');
        const inputKategoriLabel = document.getElementById('kategori');
        const inputUrl= document.getElementById('url');
        const form = document.getElementById('form-modal');
        const submit = document.getElementById('submit-modal');

        submit.style.display = origin == 0 ?"none" : "block";

        inputUrl.value = data;

        inputUrl.addEventListener('keyup', function(){
            submit.style.display = inputUrl.value ? "block" : "none";
        })

        form.setAttribute('action',`/jadwal-ujian/levelsubjectid=${subject}`)
        labelHeader.innerText = origin == 0 ? `Tambah URL Ujian ${kategori}` : `Ubah URL Ujian ${kategori}`;
        inputKategoriLabel.value = kategori;


    }

    window.addEventListener('load', async function(){

    })
    

</script>
    
@endsection