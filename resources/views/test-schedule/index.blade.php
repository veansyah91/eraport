@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Jadwal Ujian  
                </h1>
              </div><!-- /.col -->          
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#setScheduleModal">Atur Jadwal Ujian</button>
                </div>
            </div>

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-8">
                        <table class="table table-sm" id="table-schedule">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Tahun Ajar</th>
                                    <th scope="col">Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testschedules as $testschedule)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $testschedule->mulai }}</td>
                                        <td>{{ $testschedule->selesai }}</td>
                                        <td>{{ $testschedule->semester->semester }}</td>
                                        <td>{{ $testschedule->semester->year->awal }}/{{ $testschedule->semester->year->akhir }}</td>
                                        <td>{{ $testschedule->kategori }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

        <!-- Modal -->
        <form method="POST" action="/test-schedule/{{Year::thisSemester()->id}}">
            @csrf
            @method('patch')
            <div class="modal fade" id="setScheduleModal" tabindex="-1" aria-labelledby="setScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="setScheduleModalLabel"><strong>Atur Jadwal Ujian</strong>    </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="mulai" class="col-form-label">Mulai Tanggal:</label>
                                    <input type="date" class="form-control" id="mulai" name="mulai" onchange="enableSubmit()">
                                </div>
                                <div class="form-group">
                                    <label for="selesai" class="col-form-label">Selesai Tanggal:</label>
                                    <input type="date" class="form-control" id="selesai" name="selesai" onchange="enableSubmit()">
                                </div>
                                <div class="form-group">
                                    <label for="kategori" class="col-form-label">Jenis Ujian:</label>
                                    <select class="custom-select" name="kategori">
                                        <option value="Tengah Semester">Tengah Semester</option>
                                        <option value="Akhir Semester">Akhir Semester</option>
                                    </select>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="submitSchedule" >Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
     
@endsection

@section('script')
<script type="text/javascript">

    function enableSubmit(){
        const submitSchedule = document.getElementById('submitSchedule');
        const mulai = document.getElementById('mulai');
        const selesai = document.getElementById('selesai');

        if (mulai.value > selesai.value) submitSchedule.disabled = true;
        if (mulai.value + 1 != 1 && selesai.value + 1 != 1 && mulai.value < selesai.value) submitSchedule.disabled = false;
    }
    window.addEventListener('load', async function(){
        $('#table-schedule').DataTable();

        const submitSchedule = document.getElementById('submitSchedule');
        submitSchedule.disabled = true;
    })
</script>
    
@endsection
