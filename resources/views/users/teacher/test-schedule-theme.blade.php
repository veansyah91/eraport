@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Atur Soal Pelajaran TEMA Ujian Kelas {{ $level->kelas }}</h1>
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
                                                <th>Cetak</th>
                                                <th>Akhir Semester</th>
                                                <th>Cetak</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @if ($themeSubjects->isEmpty())
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        <i>Tema Belum Diatur</i>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($themeSubjects as $themeSubject)
                                                    <tr class="text-center">
                                                        <td>
                                                                {{ $themeSubject->tema }} 
                                                                <button class="btn btn-sm btn-link" data-toggle="modal" 
                                                                data-target="#themeEditModal" onclick="editTheme({{$themeSubject->id}}, '{{$themeSubject->tema}}')">
                                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                    </svg>
                                                                </button>
                                                                <button class="btn btn-sm btn-link" data-toggle="modal" 
                                                                data-target="#themeDeleteModal" onclick="deleteTheme({{$themeSubject->id}})">
                                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            
                                                        @foreach ($periods as $period)
                                                            @if ($period->period != 'Harian')
                                                                <td>
                                                                    Jumlah Soal: {{ Test::countThemeQuestion($themeSubject->id, $period->id) }} Nomor

                                                                    <a class="btn btn-sm btn-link" href="/ujian/tema/levelid={{ $level->id }}/semesterId={{ Year::thisSemester()->id }}/periodId={{ $period->id }}/themeId={{ $themeSubject->id }}/showTest">
                                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                        </svg>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="/ujian/tema/periodId={{ $period->id }}/themeId={{ $themeSubject->id }}/print"

                                                                        class="btn btn-sm btn-outline-success" 
                                                                        >
                                                                        Cetak Untuk Siswa
                                                                    </a>
                                                                    <a
                                                                        href="/ujian/tema/themeId={{ $themeSubject->id }}/file"
                                                                        class="btn btn-sm btn-outline-primary" 
                                                                        >
                                                                        Cetak Untuk Arsip
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        @endforeach
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

    <form action="/ujian/tema/levelId={{ $level->id }}/semesterId={{ Year::thisSemester()->id }}/create" method="post" id="form-url-tema">
        @csrf
        <div class="modal fade" id="themeUrlModal" tabindex="-1" aria-labelledby="themeUrlModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-Url-title-modal" id="themeUrlModalLabel">Tambah Tema</h5>
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
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitSchedule-tema">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="/ujian/tema/levelId={{ $level->id }}/semesterId={{ Year::thisSemester()->id }}/update" method="post" id="edit-theme-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="themeEditModal" tabindex="-1" aria-labelledby="themeEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-Url-title-modal" id="themeEditModalLabel">Atur URL Form Ujian Tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <input type="hidden" id="theme-id" name="themeId">
                            <label for="kategori" class="col-sm-2 col-form-label">Tema</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="tema" id="edit-theme">
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
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitSchedule-tema">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post" id="theme-delete-form" action="/ujian/tema/levelId={{ $level->id }}/semesterId={{ Year::thisSemester()->id }}/delete">
        @csrf
        @method('delete')
        <div class="modal fade" id="themeDeleteModal" tabindex="-1" role="dialog" aria-labelledby="themeDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <input type="hidden" id="theme-delete" name="themeId">
                    <div class="modal-body text-center">
                        <img src="{{asset('img/delete.png')}}" class="text-center" style="width: 50%;opacity: .5">
                        <p class="h4 mt-3"><strong>Apakah Anda Yakin Menghapus Soal Ini?</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
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
    const editTheme = (id, tema) => {
        // const editFormModal = document.getElementById('edit-theme-form')
        const themeId = document.getElementById('theme-id')
        const themeEdit = document.getElementById('edit-theme')

        themeEdit.value = tema
        themeId.value = id
    }

    const deleteTheme = (id) => {
        const themeDelete = document.getElementById('theme-delete')

        themeDelete.value = id
    }

    window.addEventListener('load', async function(){
        
    })
    

</script>
    
@endsection