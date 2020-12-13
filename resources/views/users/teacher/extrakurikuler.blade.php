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
                                    <h5><strong>Ekstrakurikuler</strong></h5>
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
                                                    <th scope="col" colspan="6">Ekstrakurikuler</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Eks 1</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Eks 2</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Eks 3</th>
                                                    <th scope="col">Keterangan</th>
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

                                                        @foreach (extracurricular($student->student_id, Year::thisSemester()->id) as $item)
                                                            <td class="text-center">
                                                                {{$item->nama}}
                                                                <button 
                                                                    class="btn btn-sm btn-link"
                                                                    
                                                                    data-target="#inputExtraModal"

                                                                    data-toggle="modal" 

                                                                    @if ($item->convert_id)
                                                                        onclick="inputExtra({{ $student->student_id }},{{ $item->extracurricular_id }}, {{ $item->convert_id }}, {{ $item->id }})"
                                                                    @else
                                                                    onclick="inputExtra({{ $student->student_id }},{{ $item->extracurricular_id }}, null, {{ $item->id }})"
                                                                    @endif
                                                                    

                                                                >
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                @if (!convert($item->convert_id))
                                                                    0
                                                                @else
                                                                    {{convert($item->convert_id)->nilai_huruf}}
                                                                @endif
                                                            </td>
                                                        @endforeach

                                                        @php
                                                            $i = 0;
                                                            $jumlah = count(extracurricular($student->student_id, Year::thisSemester()->id));
                                                            $sisa = 3 - $jumlah;
                                                        @endphp


                                                        @while ($i < $sisa)
                                                            <td class="text-center">
                                                                -
                                                                <button 
                                                                    class="btn btn-sm btn-link"

                                                                    onclick="inputExtra({{ $student->student_id }}, null, null, null)"

                                                                    data-target="#inputExtraModal"

                                                                    data-toggle="modal" 
                                                                >
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td>-</td>
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endwhile
                                                        
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

    <form action="/subLevelId={{ $sublevel->id }}/ekstrakurikuler" method="post">
        @csrf
        @method('patch')
        <div class="modal fade" id="inputExtraModal" tabindex="-1" aria-labelledby="inputExtraModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputExtraModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="extraValueIdModal" name="extraValueIdModal">
                        <input type="hidden" id="page" name="page">
                        <div class="form-group">
                            <label for="studentInputExtra">Nama</label>
                            <select class="form-control" id="studentInputExtraModal" name="studentInputExtraModal" >
                                @foreach ($sublevelstudents as $student)
                                    <option value="{{$student->student_id}}">{{$student->nama}}</option>
                                @endforeach
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="inputExtra">Ekstrakurikuler</label>
                            <select class="form-control" id="inputExtraModal" name="inputExtraModal">
                                @foreach ($extracurriculars as $extra)
                                    <option value="{{$extra->id}}">{{$extra->nama}}</option>
                                @endforeach
                            </select>   
                        </div>
                        <div class="form-group">
                            <label for="inputScoreExtra">Nilai</label>
                            <select class="form-control" id="inputScoreExtraModal" name="inputScoreExtraModal">
                                @foreach ($converts as $convert)
                                    <option value="{{$convert->id}}">{{$convert->nilai_huruf}}</option>
                                @endforeach
                            </select>   
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
    const inputExtra = (studentId, extraId, extraValue, extraValueId) => {
        const studentNameModal = document.getElementById('studentInputExtraModal')
        const inputExtraHeader = document.getElementById('inputExtraModalLabel')
        const inputExtra = document.getElementById('inputExtraModal')
        const extraValueIdModal = document.getElementById('extraValueIdModal')
        const inputScoreExtraModal = document.getElementById('inputScoreExtraModal')
        const page = document.getElementById('page')

        studentNameModal.value = studentId
        inputExtraHeader.innerText = extraValueId ? 'Ubah Ekstrakurokuler' : 'Atur Ekstrakurikuler'
        inputExtra.value = extraId
        extraValueIdModal.value = extraValueId

        inputScoreExtraModal.value = extraValue

        thisPage = window.location.href
        thisPageSplit = thisPage.split("ekstrakurikuler")
        
        page.value = thisPageSplit[1]
        
    }

    window.addEventListener('load', async function(){
        console.log(window.location.href);
    })
    

</script>
    
@endsection