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
                                    <h5><strong>Saran</strong></h5>
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
                                                    <th scope="col">Saran</th>
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
                                                        <td class="text-center">
                                                            {{ Score::advice($student->student_id, Year::thisSemester()->id, $sublevel->level_id) }}
                                                            <button 
                                                                class="btn btn-sm btn-link"

                                                                @if (Score::advice($student->student_id, Year::thisSemester()->id, $sublevel->level_id))
                                                                    onclick="tambahSaran({{ $student->student_id }},'{{Score::advice($student->student_id, Year::thisSemester()->id, $sublevel->level_id)}}')"
                                                                @else
                                                                    onclick="tambahSaran({{ $student->student_id }},null)"
                                                                @endif
                                                                

                                                                data-target="#inputSaranModal"

                                                                data-toggle="modal" 
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

    <form action="/subLevelId={{ $sublevel->id }}/saran" method="post">
        @csrf
        @method('patch')
        <div class="modal fade" id="inputSaranModal" tabindex="-1" aria-labelledby="inputSaranModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputSaranModalLabel">Tambah Saran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="saranValueIdModal" name="saranValueIdModal">
                        <input type="hidden" id="page" name="page">
                        <div class="form-group">
                            <label for="studentInput">Nama</label>
                            <select class="form-control" id="studentInputModal" name="studentInputModal" >
                                @foreach ($sublevelstudents as $student)
                                    <option value="{{$student->student_id}}">{{$student->nama}}</option>
                                @endforeach
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="inputSaran">Saran</label>
                            <textarea class="form-control" name="inputSaran" id="inputSaran" cols="10" rows="2"></textarea>
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
    const tambahSaran = (studentId, saran) => {
        const studentNameModal = document.getElementById('studentInputModal')
        const inputSaran = document.getElementById('inputSaran')
        const page = document.getElementById('page')
        
        studentNameModal.value = studentId
        inputSaran.value = saran

        thisPage = window.location.href
        thisPageSplit = thisPage.split("saran")
        
        page.value = thisPageSplit[1]
        
    }

    window.addEventListener('load', async function(){
    })
    

</script>
    
@endsection