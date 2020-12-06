@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Soal Ujian Kelas {{ $levelsubject->level->kelas }}</h1>
                    <h3>Mata Pelajaran {{ $levelsubject->subject->mata_pelajaran }}</h3>
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="/ujian/levelsubjectid={{ $levelsubject->id }}/periodid={{ $scoreratio->id }}/create" class="btn btn-primary">Tambah Soal</a>
                </div>
                <div class="col-sm-6">
                    <a href="/ujian/levelsubjectid={{ $levelsubject->id }}" class="btn btn-link float-right">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>Halaman Sebelumnya
                    </a>
                </div>
            </div>
            @foreach ($questions as $question)
                <div class="row">
                    <div class="col-sm-1">
                        <div class="card">
                            <div class="card-body  bg-gradient-secondary text-white">
                                <div class="row text-center">
                                    <div class="col-sm-12 font-weight-bold">
                                        No : {{ $question->number }}
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12">
                                        <button class="btn btn-sm btn-light" onclick="changeNumber({{ $question->id }}, {{ $question->number }})" data-toggle="modal" data-target="#numberUpdateModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    KD : <strong>{{ Test::kd($question->knowledge_base_competence_id)->kode }}. {{ ucfirst(Test::kd($question->knowledge_base_competence_id)->pengetahuan_kompetensi_dasar) }}</strong> 
                                    <button class="btn btn-sm btn-link" data-toggle="modal" data-target="#kdUpdateModal" onclick="changeKD({{ $question->id }}, {{ $question->knowledge_base_competence_id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    Soal:
                                </div>
                                @if ($question->image)
                                    <div class="row">
                                        <img src="{{asset('img/test/'.$question->image)}}" alt="gambar_no_{{ $question->number }}" class="img-thumbnail" style="width: 150px">
                                        <button class="btn btn-link" data-toggle="modal" data-target="#imageDeleteModal" onclick="deleteImage({{ $question->id }})">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#imageUpdateModal" onclick="changeImage({{ $question->id }}, 'Ubah Gambar')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                @else
                                <div class="row">
                                    <i>Gambar Tidak Ada</i>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#imageUpdateModal" onclick="changeImage({{ $question->id }}, 'Tambah Gambar')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                @endif

                                @if ($question->explanation)
                                    <div class="row">
                                        {{ ucfirst($question->explanation) }} 
                                        <button class="btn btn-link" data-toggle="modal" data-target="#explanationUpdateModal" onclick="changeExplanation({{ $question->id }}, '{{ $question->question }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                @else
                                <div class="row">
                                    <i>Keterangan Tidak Ada</i>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#explanationUpdateModal" onclick="changeExplanation({{ $question->id }}, '')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                @endif
                                
                                <div class="row">
                                    {{ ucfirst($question->question) }} 
                                    <button class="btn btn-link" data-toggle="modal" data-target="#questionUpdateModal" onclick="changeQuestion({{ $question->id }}, '{{ $question->question }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    Tipe Jawaban : <strong> {{ $question->answer_type }} </strong>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#answerTypeUpdateModal" onclick="changeAnswerType({{ $question->id }}, '{{ $question->answer_type }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    Kunci Jawaban : <strong> {{ ucfirst($question->answer) }} </strong>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#keyUpdateModal" onclick="changeKey({{ $question->id }}, '{{ $question->answer }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                @if ($question->answer_type == 'objective')
                                    <div class="row ">
                                        Jumlah Opsi Jawaban : <strong> {{ $question->number_of_answers }}</strong> 
                                        <button class="btn btn-link" data-toggle="modal" data-target="#answersUpdateModal" onclick="changeAnswers({{ $question->id }}, '{{ $question->number_of_answers }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        Jawaban :
                                        <ol type="a"> 
                                            @if (Test::answer($question->id)->isNotEmpty())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach (Test::answer($question->id) as $item)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <li>
                                                        {{ $item->detail }} 
                                                        <button class="btn btn-link" data-toggle="modal" data-target="#answerOptionUpdateModal" onclick="changeAnswerOption({{ $question->id }}, {{ $item->id }}, '{{ $item->detail }}', '{{ $item->option }}')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </li>   
                                                @endforeach
                                            @else
                                                @for ($i = 0; $i < $question->number_of_answers; $i++)
                                                    <li>
                                                        <i>jawaban belum diisi</i>
                                                        <button class="btn btn-link" data-toggle="modal" data-target="#answerOptionUpdateModal" onclick="changeAnswerOption({{ $question->id }}, null, null, null)">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </li>
                                                @endfor
                                            @endif

                                            @if ( $question->number_of_answers - $i != 0)
                                                @for ($index = 0; $index < $question->number_of_answers - $i; $index++)
                                                    <li>
                                                        <i>jawaban belum diisi</i>
                                                        <button class="btn btn-link" data-toggle="modal" data-target="#answerOptionUpdateModal" onclick="changeAnswerOption({{ $question->id }}, null, null)">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </li>
                                                @endfor
                                            @endif
                                        </ol>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="card">
                            <div class="card-body bg-danger text-white">
                                <div class="row text-center">
                                    <div class="col-sm-12 font-weight-bold">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#questionDeleteModal" onclick="deleteQuestion({{ $question->id}} )"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <form method="post" id="number-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="numberUpdateModal" tabindex="-1" aria-labelledby="numberUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="numberUpdateModalLabel">Ubah Nomor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="number" class="col-sm-3 col-form-label">Nomor</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name='number' id="number">
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

    <form method="post" id="kd-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="kdUpdateModal" tabindex="-1" aria-labelledby="kdUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kdUpdateModalLabel">Ubah Nomor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="kd" class="col-sm-2 col-form-label">KD</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="knowledge-competence" name="kd">
                                    @foreach ($knowledgeCompetences as $knowledgeCompetence)
                                        <option value="{{ $knowledgeCompetence->id }}">{{ $knowledgeCompetence->kode }}. {{ ucfirst($knowledgeCompetence->pengetahuan_kompetensi_dasar) }}</option>
                                    @endforeach
                                </select>
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

    <form method="post" id="image-delete-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="imageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="imageDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="{{asset('img/delete.png')}}" class="text-center" style="width: 50%;opacity: .5">
                        <p class="h4 mt-3"><strong>Apakah Anda Yakin Menghapus Gambar Ini?</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post" id="image-update-form" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="modal fade" id="imageUpdateModal" tabindex="-1" aria-labelledby="imageUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageUpdateModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name='image' id="image">
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

    <form method="post" id="question-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="questionUpdateModal" tabindex="-1" aria-labelledby="questionUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="questionUpdateModalLabel">Ubah Pertanyaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Pertanyaan</label>
                            <div class="col-sm-10">
                                <div class="col-sm-9">
                                    <textarea class="form-control" aria-label="With textarea" name="pertanyaan" id="question-input"></textarea>
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

    <form method="post" id="answer-type-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="answerTypeUpdateModal" tabindex="-1" aria-labelledby="answerTypeUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="answerTypeUpdateModalLabel">Ubah Tipe Jawaban</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Tipe Jawaban</label>
                            <div class="col-sm-9">
                                <select class="custom-select" id="answer-type" name="answertype">
                                        <option value="objective">Objective</option>
                                        <option value="essay">Essay</option>
                                    
                                </select>
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

    <form method="post" id="key-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="keyUpdateModal" tabindex="-1" aria-labelledby="keyUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="keyUpdateModalLabel">Ubah Kunci Jawaban</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="key" class="col-sm-4 col-form-label">Kunci Jawaban</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name='key' id="key">
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

    <form method="post" id="answers-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="answersUpdateModal" tabindex="-1" aria-labelledby="answersUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="answersUpdateModalLabel">Ubah Jumlah Jawaban</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label">Jumlah Jawaban</label>
                            <div class="col-sm-8">
                                <select class="custom-select" id="answers" name="answers">
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
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

    <form method="post" id="question-delete-form">
        @csrf
        @method('delete')
        <div class="modal fade" id="questionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="questionDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
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

    <form method="post" id="answer-option-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="answerOptionUpdateModal" tabindex="-1" aria-labelledby="answerOptionUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="answerOptionUpdateModalLabel">Ubah Pilihan Jawaban</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="answer-id-modal" name="answerId">
                        <div class="row">
                            <label for="answer-detail-modal" class="col-sm-4 col-form-label">Pilihan Jawaban</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="answerObj" id="answer-obj-modal">
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="answerDetail" id="answer-detail-modal">
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

    <form method="post" id="explanation-update-form">
        @csrf
        @method('patch')
        <div class="modal fade" id="explanationUpdateModal" tabindex="-1" aria-labelledby="explanationUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="explanationUpdateModalLabel">Ubah Keterangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <div class="col-sm-9">
                                    <input class="form-control" name="keterangan" id="explanation-input">
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

    const changeNumber = (id, numberValue) => {
        const number = document.getElementById('number')
        const numberUpdateForm = document.getElementById('number-update-form')

        number.value = numberValue
        numberUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-number`)
    }

    const changeKD = (id, kdValue) => {
        const kd = document.getElementById('knowledge-competence')
        const kdUpdateForm = document.getElementById('kd-update-form')

        kd.value = kdValue
        kdUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-kd`)
    }

    const changeImage = (id, kategori) => {
        const imageUpdateModalHeader = document.getElementById('imageUpdateModalLabel')
        const imageUpdateForm = document.getElementById('image-update-form')

        imageUpdateModalHeader.innerText = kategori
        imageUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-image`)
    }

    const deleteImage = (id) => {
        const deleteImageForm = document.getElementById('image-delete-form')

        deleteImageForm.setAttribute("action",`/ujian/questionId=${id}/delete-image`)
    }

    const changeQuestion = (id, question) => {
        const questionUpdateForm = document.getElementById('question-update-form')
        const questionInput = document.getElementById('question-input')

        questionInput.value = question
        questionUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-question`)
    }

    const changeAnswerType = (id, answerType) => {
        const answerTypeUpdateForm = document.getElementById('answer-type-update-form')
        const answerTypeInput = document.getElementById('answer-type')

        answerTypeInput.value = answerType
        answerTypeUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-answer-type`)
    }

    const changeKey = (id, answer) => {
        const keyUpdateForm = document.getElementById('key-update-form')
        const keyInput = document.getElementById('key')

        key.value = answer
        keyUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-answer`)
    }

    const changeAnswers = (id, numberAnswers) => {
        const answersUpdateForm = document.getElementById('answers-update-form')
        const answers = document.getElementById('answers')

        answers.value = numberAnswers
        answersUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-answers`)
    }

    const deleteQuestion = (id) => {
        const questionDeleteForm = document.getElementById('question-delete-form')

        questionDeleteForm.setAttribute("action",`/ujian/questionId=${id}/delete-question`)
    }

    const changeAnswerOption = (questionId, answerId, answerDetail, answerObj) => {
        const answerOptionUpdateForm = document.getElementById('answer-option-update-form')
        const answerDetailModal = document.getElementById('answer-detail-modal')
        const answerObjModal = document.getElementById('answer-obj-modal')
        const answerIdModal = document.getElementById('answer-id-modal')

        answerDetailModal.value = answerDetail
        answerObjModal.value = answerObj
        answerIdModal.value = answerId

        answerOptionUpdateForm.setAttribute("action",`/ujian/questionId=${questionId}/update-answer-option`)
    }

    const changeExplanation = (id, explanation) => {
        const explanationUpdateForm = document.getElementById('explanation-update-form')
        const explanationInput = document.getElementById('explanation-input')

        explanationInput.value = explanation
        explanationUpdateForm.setAttribute("action",`/ujian/questionId=${id}/update-explanation`)
    }

    window.addEventListener('load', async function(){
    })
    

</script>
    
@endsection