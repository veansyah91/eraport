@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian Spiritual (K1)</h1>
                    <h1>{{ $studentDetail->nama }} </h1>
                    <h1>Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>

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
                <div class="col-sm-6">
                    <a href="/subLevelId={{ $sublevel->id }}/penilaian/spiritual" class="btn btn-link btn-sm">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Halaman Sebelumnya
                    </a>
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5><strong>Isi Nilai Aspek Spiritual</strong></h5>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="/subLevelId={{ $sublevel->id }}/studentId={{ $studentDetail->id }}/penilaian/spiritual" method="POST">
                                        @csrf
                                        @method('patch')
                                        @foreach ($spirituals as $spiritual)
                                            <div class="form-group row">
                                                <input type="hidden" name="spiritualPeriod[{{ $loop->iteration }}]" value="{{ $spiritual->id }}">
                                                <label for="spiritualscore[{{ $loop->iteration }}]" class="col-sm-2 col-form-label">Aspek {{ $loop->iteration }}</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="spiritualscore[{{ $loop->iteration }}]" id="spiritual{{ $loop->iteration }}" value="{{ Test::spiritualScore($spiritual->id, $studentDetail->id) }}">
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                        <div class="row float-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5><strong>Detail Aspek Spiritual</strong></h5>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table>         
                                        @foreach ($spirituals as $spiritual)
                                            <tr>
                                                <th>Aspek {{ $loop->iteration }}</th>
                                                <td>: {{ $spiritual->spiritual->aspek }}</td>
                                            </tr>
                                        @endforeach
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
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

<script>

    window.addEventListener('load', async function(){

    })
    

</script>
    
@endsection