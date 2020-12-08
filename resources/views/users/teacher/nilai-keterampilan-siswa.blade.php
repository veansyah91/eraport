@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian {{ $student->nama }}</h1>
                    <h1>Kelas{{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    <h4>KD 4 {{ $levelsubject->subject->mata_pelajaran }}</h4>
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
                                    <h5><strong>Nilai Keterampilan (K-4)</strong></h5>
                                </div>
                                <div class="col-sm-6 ">
                                    <a href="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/nilai-keterampilan" class="btn btn-sm btn-link float-right"><i class="fas fa-arrow-left"></i> Halaman Sebelumnya</a>
                                </div>
                            </div>
                            
                        </div>
                        
                        <form action="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/{{ $student->id }}/nilai-keterampilan" method="post">
                            <div class="row">                            
                                @csrf
                                @method('patch')
                                @foreach ($basecompetences as $basecompetence)
                                    <input type="hidden" name="kd[{{ $loop->iteration }}]" value="{{ $basecompetence->id }}">
                                    <div class="col-sm-4">
                                        <div class="card-body">
                                            <h4>KD. {{ $basecompetence->kode }}</h4>
                                            <div class="form-group row">
                                                <label for="nilaiPraktek[{{ $loop->iteration }}]" class="col-sm-3 col-form-label">Praktek</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="nilaiPraktek[{{ $loop->iteration }}]" id="nilaiPraktek[{{ $loop->iteration }}]"

                                                        @if (!is_object(Score::practiceScore($student->id,$basecompetence->id)) || !Score::practiceScore($student->id,$basecompetence->id)->praktek)
                                                            value=""
                                                        @else
                                                            value="{{Score::practiceScore($student->id,$basecompetence->id)->praktek}}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nilaiProyek[{{ $loop->iteration }}]" class="col-sm-3 col-form-label">Proyek</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="nilaiProyek[{{ $loop->iteration }}]" id="nilaiProyek[{{ $loop->iteration }}]"

                                                        @if (!is_object(Score::practiceScore($student->id,$basecompetence->id)) || !Score::practiceScore($student->id,$basecompetence->id)->proyek)
                                                            value=""
                                                        @else
                                                            value="{{Score::practiceScore($student->id,$basecompetence->id)->proyek}}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nilaiProduk[{{ $loop->iteration }}]" class="col-sm-3 col-form-label">Produk</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="nilaiProduk[{{ $loop->iteration }}]" id="nilaiProduk[{{ $loop->iteration }}]"

                                                        @if (!is_object(Score::practiceScore($student->id,$basecompetence->id)) || !Score::practiceScore($student->id,$basecompetence->id)->produk)
                                                            value=""
                                                        @else
                                                            value="{{Score::practiceScore($student->id,$basecompetence->id)->produk}}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
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