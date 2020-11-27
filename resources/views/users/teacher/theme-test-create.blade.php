@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Soal Ujian Kelas {{ $level->kelas }}</h1>
                    <h3>{{ $themesubject->tema }}</h3>
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
                        <div class="card-body">
                            <form action="/ujian/tema/levelid={{ $level->id }}/semesterId={{ $semester->id }}/periodId={{ $scoreratio->id }}/themeId={{ $themesubject->id }}/storeTest" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="themeId" id="theme-id" value="{{ $themesubject->id }}">
                                <div class="row mb-2">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nomor</span>
                                        </div>
                                        <input type="text" class="form-control" name="number" value="{{ $questions + 1 }}">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFile">Input Gambar</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="image">Pilih</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <small class="text-danger float-right">***Jika Ada</small>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Keterangan</span>
                                        </div>
                                        <textarea class="form-control" aria-label="With textarea" name="keterangan">{{ old('keterangan') }}</textarea>
                                        
                                    </div>
                                    @error('keterangan')
                                        <div class="col-sm-12">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="row mb-2">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Pertanyaan</span>
                                        </div>
                                        <input class="form-control" aria-label="With textarea" name="pertanyaan" value="{{ old('pertanyaan') }}"/>
                                        
                                    </div>
                                    @error('pertanyaan')
                                        <div class="col-sm-12">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">KD</span>
                                        </div>
                                        <select class="custom-select kd-select" id="knowledge-competence" name="kd" style="height: 100%">
                                            @foreach ($knowledgeCompetences as $knowledgeCompetence)
                                                <option value="{{ $knowledgeCompetence->id }}">{{ $knowledgeCompetence->kode }}. {{ ucfirst($knowledgeCompetence->pengetahuan_kompetensi_dasar) }} - {{ ucfirst($knowledgeCompetence->mata_pelajaran) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" id="enable-objective-answer" name="objective">
                                            <label class="form-check-label" for="enable-objective-answer">
                                                Jawaban Objective
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="total-option">
                                        <div class="input-group" >
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="total-answer">Jumlah Jawaban</label>
                                            </div>
                                            <select class="custom-select" id="total-answer" name="jumlahjawaban">
                                                <option value="3" selected>3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="objective-answer">
                                    
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Kunci Jawaban</span>
                                        </div>
                                        <input class="form-control" name="jawaban" id="key" value="{{ old('nik') }}">
                                    </div>
                                    @error('jawaban')
                                        <div class="col-sm-12">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <a 
                                        href="/ujian/tema/levelid={{ $level->id }}/semesterId={{ $semester->id }}/periodId={{ $scoreratio->id }}/themeId={{ $themesubject->id }}/showTest" 
                                        class="btn btn-secondary"
                                        >
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary " id="save-button">Simpan</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
 
<script>

    const handleObjectiveAnswer = (objectiveAnswer, totalAnswer) => {
        let answer = ''

        objectiveAnswer.innerHTML = ''
        for (let index = 0; index < totalAnswer.value; index++) {
            answer += `<div class="row mb-2 form-group ">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="radio" name="the-answer" id="answerRadios${ index  }" onClick="handleAnswer(${ index  })">
                    </div>
                </div>
                    <div class="col-sm-11">
                        <input type="text" class="form-control input-answer" name="answer[${ index  }]" id="inputAnswer${ index }">
                    </div>
                </div>`
        }
        objectiveAnswer.innerHTML = answer
    }

    const handleAnswer = (i) => {
        const selectAnswer = document.getElementById(`inputAnswer${ i }`)
        const key = document.getElementById('key')

        key.value = selectAnswer.value
    }

    window.addEventListener('load', async function(){
        $('.kd-select').select2();

        const enableObjectiveAnswer = document.getElementById('enable-objective-answer')
        const objectiveAnswer = document.getElementById('objective-answer')
        const totalOption = document.getElementById('total-option')
        const totalAnswer = document.getElementById('total-answer')
        const key = document.getElementById('key')
        const save = document.getElementById('save-button')

        totalOption.style.display = "none"
        key.value = ''

        if (enableObjectiveAnswer.checked) {
            totalOption.style.display = "block"

            handleObjectiveAnswer(objectiveAnswer, totalAnswer)

            totalAnswer.addEventListener('change', function(){
                handleObjectiveAnswer(objectiveAnswer, totalAnswer)
            })


        }

        enableObjectiveAnswer.addEventListener('click', () => {
            enableObjectiveAnswer.checked ? totalOption.style.display = "block" : totalOption.style.display = "none"

            if (enableObjectiveAnswer.checked) {
                
                handleObjectiveAnswer(objectiveAnswer, totalAnswer)

                totalAnswer.addEventListener('change', function(){
                    handleObjectiveAnswer(objectiveAnswer, totalAnswer)
                })

            } else {
                objectiveAnswer.innerHTML = ''
            }
        })
    })
    

</script>
    
@endsection