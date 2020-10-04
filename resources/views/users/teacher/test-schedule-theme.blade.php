@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Atur Jadwal Ujian Kelas {{ $level->kelas }}</h1>
                    <h3><strong>Tema</strong> </h3>
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
                                    <div class="row mb-3">
                                        <button 
                                        class="btn btn-sm btn-primary" 
                                        data-toggle="modal" 
                                        data-target="#themeUrlModal"
                                        >
                                            Tambah Tema
                                        </button>
                                    </div>
                                    <table class="table table-responsive" id="table-student">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Tema</th>
                                                    <th>Tengah Semester</th>
                                                    <th>Akhir Semester</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @if ($themeTestUrls->isEmpty())
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                            <i>Tema Belum Diatur</i>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($themeTestUrls as $themeTestUrl)
                                                        <tr class="text-center">
                                                            <td>
                                                                {{ $themeTestUrl->tema }}
                                                            </td>
                                                            <td>

                                                                @if (TestSchedule::urlTest($themeTestUrl->tema, "Tengah Semester", $level->id))
                                                                    
                                                                    <a class="btn btn-sm btn-link" href="{{TestSchedule::urlTest($themeTestUrl->tema, "Tengah Semester", $level->id)->url}}" target="_blank" >Sudah Dinput</a>
                                                                    <button
                                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                                        data-toggle="modal" data-target="#urlModal"
                                                                        onclick="updateUrlTest('{{ $themeTestUrl->tema }}','Tengah Semester','{{TestSchedule::urlTest($themeTestUrl->tema, 'Tengah Semester', $level->id)->url}}','{{ $level->id }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                @else
                                                                    <i>URL belum dimasukkan</i>
                                                                    <button
                                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                                        data-toggle="modal" data-target="#urlModal"
                                                                        onclick="updateUrlTest('{{ $themeTestUrl->tema }}','Tengah Semester',null,'{{ $level->id }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                @endif
                                                                
                                                                
                                                            </td>
                                                            <td>
                                                                @if (TestSchedule::urlTest($themeTestUrl->tema, "Akhir Semester", $level->id))

                                                                    <a class="btn btn-sm btn-link" href="{{TestSchedule::urlTest($themeTestUrl->tema, "Akhir Semester", $level->id)->url}}" target="_blank">Sudah Dinput</a>
                                                                    <button
                                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                                        data-toggle="modal" data-target="#urlModal"
                                                                        onclick="updateUrlTest('{{ $themeTestUrl->tema }}','Akhir Semester','{{TestSchedule::urlTest($themeTestUrl->tema, 'Akhir Semester', $level->id)->url}}','{{ $level->id }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                @else
                                                                    <i>URL belum dimasukkan</i>
                                                                    <button
                                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                                        data-toggle="modal" data-target="#urlModal"
                                                                        onclick="updateUrlTest('{{ $themeTestUrl->tema }}','Akhir Semester',null,'{{ $level->id }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

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

    <form action="/url-ujian/tema/levelid={{ $level->id }}" method="post" id="form-url-tema">
        @csrf
        @method('patch')
        <div class="modal fade" id="themeUrlModal" tabindex="-1" aria-labelledby="themeUrlModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-Url-title-modal" id="themeUrlModalLabel">Tambah URL Form Ujian Tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Tema</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="tema" id="tema">
                                    <option value="Tema 1">Tema 1</option>
                                    <option value="Tema 2">Tema 2</option>
                                    <option value="Tema 3">Tema 3</option>
                                    <option value="Tema 4">Tema 4</option>
                                    <option value="Tema 5">Tema 5</option>
                                    <option value="Tema 6">Tema 6</option>
                                    <option value="Tema 7">Tema 7</option>
                                    <option value="Tema 8">Tema 8</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="mid-semester-checkbox" name="midsemestercheckbox">
                                    <label class="custom-control-label" for="mid-semester-checkbox">Tengah Semester</label>
                                  </div>
                                <div class="form-group row">
                                    <label for="url-tema-mid" class="col-sm-2 col-form-label" >URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="url-tema-mid" name="urltemamid" placeholder="URL">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 ml-auto">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="last-semester-checkbox" name="lastsemestercheckbox">
                                    <label class="custom-control-label" for="last-semester-checkbox">Akhir Semester</label>
                                  </div>
                                <div class="form-group row">
                                    <label for="url-tema-last" class="col-sm-2 col-form-label">URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="url-tema-last" name="urltemalast" placeholder="URL">
                                    </div>
                                </div>
                            </div>
                          </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitSchedule-tema">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="/url-ujian/tema/levelid={{ $level->id }}" method="post" id="form-url-tema-semester">
        @csrf
        @method('patch')
        <div class="modal fade" id="urlModal" tabindex="-1" aria-labelledby="urlModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-Url-title-modal" id="urlModalLabel">Atur URL Form Ujian Tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="tema" class="col-sm-2 col-form-label">Tema</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tema-input" name="tema" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Semester" readonly>
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
                        <button type="submit" class="btn btn-primary" id="submitSchedule-tema">Simpan</button>
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
    function updateUrlTest(tema, kategori, url, level){
        const temaInput = document.getElementById('tema-input')
        const kategoriInput = document.getElementById('kategori')
        const urlInput = document.getElementById('url')
        const form = document.getElementById('form-url-tema-semester')

        form.setAttribute('action',`/url-ujian/tema/update/levelid=${level}`)
        temaInput.value = tema
        kategoriInput.value = kategori 
        urlInput.value = url
    }

    window.addEventListener('load', async function(){
        const urlMidTema = document.getElementById('url-tema-mid');
        urlMidTema.disabled = true;

        const urllastTema = document.getElementById('url-tema-last');
        urllastTema.disabled = true;

        const midCheckBoxModal = document.getElementById('mid-semester-checkbox');
        const lastCheckBoxModal = document.getElementById('last-semester-checkbox');

        midCheckBoxModal.value = 0;
        lastCheckBoxModal.value = 0;

        midCheckBoxModal.addEventListener('click', () => {

            if (midCheckBoxModal.value == 0) {
                midCheckBoxModal.value = 1;
                urlMidTema.disabled = false;
            } else {
                midCheckBoxModal.value = 0;
                urlMidTema.disabled = true;
            }
        })

        lastCheckBoxModal.addEventListener('click', () => {
            if (lastCheckBoxModal.value == 0) {
                lastCheckBoxModal.value = 1;
                urllastTema.disabled = false;
            } else {
                lastCheckBoxModal.value = 0;
                urllastTema.disabled = true;
            }
        })
    })
    

</script>
    
@endsection