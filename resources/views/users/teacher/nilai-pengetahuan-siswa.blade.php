@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian {{ $student->nama }}</h1>
                    <h1>Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    <h4>KD 3 Mata Pelajaran {{ $levelsubject->subject->mata_pelajaran }}</h4>
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
                                    <h5><strong>Nilai Pengetahuan (K-3)</strong></h5>
                                </div>
                                <div class="col-sm-6 ">
                                    <a href="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/nilai-pengetahuan" class="btn btn-sm btn-link float-right"><i class="fas fa-arrow-left"></i> Halaman Sebelumnya</a>
                                </div>
                            </div>
                            
                        </div>

                        <form action="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/{{ $student->id }}/nilai-pengetahuan" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                @php
                                    $indexRatio = 1;
                                @endphp
                                @foreach ($ratio as $r)
                                <div class="col-sm-4">
                                    <div class="card-body">
                                        <h4>{{ $r->period }}</h4> 
                                        
                                        @foreach ($basecompetences as $basecompetence)
                                            <div class="form-group row">
                                                <input type="hidden" name="ratio[{{ $indexRatio }}]" value="{{ $r->id }}">
                                                <input type="hidden" name="kd[{{ $loop->iteration }}]" value="{{ $basecompetence->id }}">
                                                <label for="knowledge[{{ $indexRatio }}][{{ $loop->iteration }}]" class="col-sm-2 col-form-label">KD. {{ $loop->iteration }}</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="scoreknowledge[{{ $indexRatio }}][{{ $loop->iteration }}]" id="knowledge[{{ $indexRatio }}][{{ $loop->iteration }}]"
                                                        @if (!is_object(Score::knowledgeScore($student->id,$r->id,$basecompetence->id))||Score::knowledgeScore($student->id,$r->id,$basecompetence->id)->score==0)
                                                            value=""    
                                                        @else 
                                                            value="{{ Score::knowledgeScore($student->id,$r->id,$basecompetence->id)->score }}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $indexRatio++;
                                        @endphp
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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