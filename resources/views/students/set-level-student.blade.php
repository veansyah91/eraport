@extends('layouts.main')

@section('content')
            <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Atur Kelas Siswa Tahun {{ Year::thisSemester()->year->awal }}/{{ Year::thisSemester()->year->akhir }}
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
                    <div class="col-12">
                      <form action="/student/set-level-student" method="post">
                        @csrf
                        <div class="form-group row">
                          <input hidden type="text" name="year_id" value="{{ Year::thisSemester()->year_id }}">
                          <input hidden type="text" name="student_id" value="{{ $student->id }}">
                          <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" id="nama" value="{{ $student->nama }}" name="nama">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="level" class="col-sm-2 col-form-label">Pilih Kelas</label>
                          <div class="col-10 col-lg-6">
                            <select class="custom-select mr-sm-2" id="level" name="level_id">
                              @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->kelas }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                      </form>
                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
        </div>
@endsection

@section('script')
<script type="text/javascript">

window.addEventListener('DOMContentLoaded', (event) => {

});

</script>

@endsection
