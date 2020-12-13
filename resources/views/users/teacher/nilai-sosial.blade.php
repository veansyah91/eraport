@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian Sosial Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
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
                                    <h5><strong>Detail Aspek Sosial</strong></h5>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="khowledge-table">
                                            <tbody>
                                                
                                                @foreach ($socials as $social)
                                                <tr>
                                                    <th>Aspek {{$loop->iteration}}</th>
                                                    <td>
                                                        {{ $social->social->aspek }}
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5><strong>Nilai Spiritual (K-1)</strong></h5>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="khowledge-table">
                                            <thead class="table-success">
                                                <tr>
                                                    <th scope="col" class="text-center" rowspan="2" style="width: 2em;vertical-align: middle;">#</th>
                                                    <th scope="col" class="text-center" rowspan="2" style="width: 2em;vertical-align: middle;">Nama</th>
                                                    <th scope="col" class="text-center" colspan="{{ count($socials) }}">Aspek</th>
                                                    <th scope="col" class="text-center" rowspan="2"></th>
                                                </tr>
                                                <tr>
                                                    @foreach ($socials as $social)
                                                        <th scope="col" class="text-center">Aspek {{$loop->iteration}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($sublevelstudents as $sublevelstudent)
                                                <tr>
                                                    <td>{{$index++}}</td>
                                                    <td>
                                                        {{$sublevelstudent->nama}}
                                                    </td>

                                                    @foreach ($socials as $social)
                                                        <td class="text-center">
                                                            {{ Test::socialScore($social->id, $sublevelstudent->student_id) }}
                                                        </td>
                                                    @endforeach
                                                    <td class="text-center">
                                                        <a href="/subLevelId={{ $sublevel->id }}/studentId={{ $sublevelstudent->student_id }}/penilaian/sosial" class="btn btn-sm btn-primary">Atur Nilai</a>
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
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

<script>

    window.addEventListener('load', async function(){

    })
    

</script>
    
@endsection