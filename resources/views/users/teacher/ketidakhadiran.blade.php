@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    <h4>Ekstrakurikuler</h4>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5><strong>Ketidakhadiran</strong></h5>
                                </div>
                            </div>
                            
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="extra-table">
                                            <thead class="table-info text-center">
                                                <tr>
                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                    <th rowspan="2" scope="col">Nama Siswa</th>
                                                    <th scope="col" colspan="3">KetidakHadiran</th>
                                                    <th rowspan="2" scope="col"></th>
                                                </tr>
                                                <tr>
                                                    <th>Sakit</th>
                                                    <th>Izin</th>
                                                    <th>Tanpa Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sublevelstudents as $student)
                                                    <tr>
                                                        
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>
                                                        <td>
                                                            {{$student->nama}}
                                                        </td>
                                                            @if (Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id))
                                                            
                                                                <td class="text-center">
                                                                    {{ Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->sakit }} Hari
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->izin }} Hari
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->tanpa_keterangan }} Hari
                                                                </td>
                                                                
                                                            @else
                                                                <td class="text-center">
                                                                    - Hari
                                                                </td>
                                                                <td class="text-center">
                                                                    - Hari
                                                                </td>
                                                                <td class="text-center">
                                                                    - Hari
                                                                </td>
                                                            @endif
                                                            
                                                        
                                                            
                                                        <td class="text-center">
                                                            <button 
                                                                class="btn btn-sm btn-link"                                                                

                                                                data-target="#inputKetidakhadiranModal"

                                                                data-toggle="modal" 

                                                                @if (Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id))
                                                                    onclick="setAbsent({{$student->student_id}}, {{ $sublevel->level_id }}, {{Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->sakit}}, {{Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->izin}}, {{Score::absent($student->student_id, Year::thisSemester()->id, $sublevel->level_id)->tanpa_keterangan}})"
                                                                @else 
                                                                    onclick="setAbsent({{$student->student_id}}, {{ $sublevel->level_id }}, 0, 0, 0)"
                                                                @endif           
                                                            >
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $sublevelstudents->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->

    <form action="/subLevelId={{ $sublevel->id }}/ketidakhadiran" method="post">
        @csrf
        @method('patch')
        <div class="modal fade" id="inputKetidakhadiranModal" tabindex="-1" aria-labelledby="inputKetidakhadiranModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputKetidakhadiranModalLabel">Tambah Ketidakhadiran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="page" name="page">
                        <div class="form-group">
                            <label for="studentInput">Nama</label>
                            <select class="form-control" id="studentInputModal" name="studentInputModal" >
                                @foreach ($sublevelstudents as $student)
                                    <option value="{{$student->student_id}}">{{$student->nama}}</option>
                                @endforeach
                            </select>                       
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputSakit">Sakit</label>
                                    <input type="number" class="form-control" name="inputSakit" id="inputSakit">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputIzin">Izin</label>
                                    <input type="number" class="form-control" name="inputIzin" id="inputIzin">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputAlfa">Tanpa Keterangan</label>
                                    <input type="number" class="form-control" name="inputAlfa" id="inputAlfa">
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    const setAbsent = (studentId, levelId, sakit, izin, alfa) => {
        const studentNameModal = document.getElementById('studentInputModal')
        const page = document.getElementById('page')
        const inputSakit = document.getElementById('inputSakit')
        const inputIzin = document.getElementById('inputIzin')
        const inputAlfa = document.getElementById('inputAlfa')
        
        studentNameModal.value = studentId
        inputSakit.value = sakit
        inputIzin.value = izin
        inputAlfa.value = alfa

        thisPage = window.location.href
        thisPageSplit = thisPage.split("ketidakhadiran")
        
        page.value = thisPageSplit[1]
        
    }

    window.addEventListener('load', async function(){
    })
    

</script>
    
@endsection