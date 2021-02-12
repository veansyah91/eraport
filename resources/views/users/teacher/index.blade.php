@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    <h4>Mata Pelajaran {{ $levelsubject->subject->mata_pelajaran }}</h4>
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
                            <h5><strong>Kompetensi Dasar (KD)</strong></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary btn-sm tambah"
                                        type="button" 
                                        class="btn btn-primary btn-sm tambah mb-2" 
                                        data-toggle="modal" 
                                        data-target="#inputModal" 
                                        data-id="{{$levelsubject->id}}"
                                        data-controller = "add-knowledge-competence"
                                        data-sublevel = "{{ $sublevel->id }}"
                                        @if ($kompetensidasar)
                                            data-jumlah="{{count($kompetensidasar)}}"
                                        @else
                                            data-jumlah="0"
                                        @endif
                                    >Tambah Kompetensi Dasar (KD) Pengetahuan</button>
                                    <div class="mt-2">
                                        <table class="table table-hover table-responsive">
                                        
                                            @if (!$kompetensidasar)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><i>Kompetensi Dasar Belum Diatur</i></td>
                                                </tr> 
                                            </tbody>
                                            @else
                                                <thead>
                                                    <tr>
                                                        <th>KD</th>
                                                        <th>Pengetahuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($kompetensidasar as $kd)
                                                    <tr>
                                                        <td>{{$kd->kode}}</td>
                                                        <td>{{$kd->pengetahuan_kompetensi_dasar}}</td>
                                                        <td style="width: 8em">
                                                            <button class="btn btn-danger btn-sm kd-delete" data-id={{$kd->id}} data-controller = "delete-knowledge-competence" data-sublevel = "{{ $sublevel->id }}" data-toggle="modal" 
                                                                data-target="#deletepayment">Hapus</button>
                                                            <button class="btn btn-success btn-sm btn-edit-kd" data-id={{$kd->id}} data-kd="{{$kd->pengetahuan_kompetensi_dasar}}" data-kode="{{$kd->kode}}" data-toggle="modal" 
                                                                data-target="#editModal" data-sublevel = "{{ $sublevel->id }}" data-controller = "edit-knowledge-competence">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif                                     
                                        
                                    </table>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <button
                                        type="button" 
                                        class="btn btn-primary btn-sm tambah" 
                                        data-toggle="modal" 
                                        data-target="#inputModal" 
                                        data-id="{{$levelsubject->id}}"
                                        data-controller = "add-practice-competence"
                                        data-sublevel = "{{ $sublevel->id }}"
                                        @if ($praktekkompetensidasar)
                                            data-jumlah="{{count($praktekkompetensidasar)}}"
                                        @else
                                            data-jumlah="0"
                                        @endif
                                    >Tambah Kompetensi Dasar (KD) Keterampilan</button>
                                    <div class="mt-2">
                                        <table class="table table-hover table-responsive">
                                        
                                            @if (!$praktekkompetensidasar)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><i>Kompetensi Dasar Belum Diatur</i></td>
                                                </tr> 
                                            </tbody>
                                            @else
                                                <thead>
                                                    <tr>
                                                        <th>KD</th>
                                                        <th>Keterampilan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($praktekkompetensidasar as $kd)
                                                    <tr>
                                                        <td>{{$kd->kode}}</td>
                                                        <td>{{$kd->keterampilan_kompetensi_dasar}}</td>
                                                        <td style="width: 8em">
                                                            <button class="btn btn-danger btn-sm kd-delete" data-id={{$kd->id}} data-controller = "delete-practice-competence" data-sublevel = "{{ $sublevel->id }}" data-toggle="modal" 
                                                                data-target="#deletepayment">Hapus</button>
                                                            <button class="btn btn-success btn-sm btn-edit-kd" data-id={{$kd->id}} data-kd="{{$kd->keterampilan_kompetensi_dasar}}" data-kode="{{$kd->kode}}" data-toggle="modal" 
                                                                data-target="#editModal" data-sublevel = "{{ $sublevel->id }}" data-controller = "edit-practice-competence">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif                                     
                                        
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
                                    <h5><strong>Nilai Pengetahuan (K-3)</strong></h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="float-right"><a href="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/nilai-pengetahuan" class="btn btn-sm btn-success">Atur Nilai</a></h5>
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
                                                    <th scope="col" class="text-center" rowspan="2" style="width: 2em">#</th>
                                                    <th scope="col" class="text-center" rowspan="2">Nama</th>
            
                                                    @foreach ($scorePeriods as $r)
                                                        <th scope="col" class="text-center" colspan="{{count($knowledgebasecompetences)}}">Penilaian {{$r->period}}</th>
                                                    @endforeach
            
                                                    <th scope="col" class="text-center" colspan="{{count($knowledgebasecompetences)}}">Rata-Rata KD</th>  
                                                    <th scope="col" class="text-center" rowspan="2">Nilai Raport</th> 
                                                    <th scope="col" class="text-center" rowspan="2">Predikat</th> 
                                                </tr>
                                                {{-- Header KD --}}
                                                <tr>
                                                    @foreach ($knowledgebasecompetences as $basecompetence)
                                                        <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                                    @endforeach
            
                                                    @foreach ($knowledgebasecompetences as $basecompetence)
                                                        <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                                    @endforeach
            
                                                    @foreach ($knowledgebasecompetences as $basecompetence)
                                                        <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                                    @endforeach
            
                                                    @foreach ($knowledgebasecompetences as $basecompetence)
                                                        <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($sublevelstudents as $sublevelstudent)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        {{$sublevelstudent->nama}}
                                                    </td>
                                                    @foreach ($scorePeriods as $r)
                                                        @foreach ($knowledgebasecompetences as $basecompetence)
                                                        
                                                            <td class="text-center">
            
                                                                @if (!is_object(Score::knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id))||Score::knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)->score == 0)
                                                                    0
                                                                @else 
                                                                    {{Score::knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)->score}}
                                                                @endif
                                                                
                                                            </td>
            
                                                        @endforeach
            
                                                    @endforeach
            
                                                    @foreach ($knowledgebasecompetences as $basecompetence)
                                                        <td scope="col" class="text-center">{{ round(Score::avScorePerCompentence($sublevelstudent->student_id, $basecompetence->id)) }}</td>
                                                    @endforeach
                                                            
                                                    {{-- Nilai Raport --}}
                                                    <td class="text-center">{{ Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id) }}</td>
            
                                                    <td class="text-center">
                                                        @if ( Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id) > 0)
                                                            {{ Score::nilaiHuruf(Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id)) }}
                                                        @else
                                                            -
                                                        @endif
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
                                    <h5><strong>Nilai Keterampilan (K-4)</strong></h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="float-right"><a href="/penilaian/{{ $sublevel->id }}/{{ $levelsubject->id }}/nilai-keterampilan" class="btn btn-sm btn-warning">Atur Nilai</a></h5>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="practice-table">
                                            <thead class="table-warning">
                                                <tr>
                                                    <th scope="col" class="text-center" rowspan="2" style="width: 2em">#</th>
                                                    <th scope="col" class="text-center" rowspan="2">Nama</th>
                                                    @foreach ($practicebasecompetences as $basecompetence)
                                                        <th scope="col" class="text-center"colspan="4">KD {{$basecompetence->kode}}</th>
                                                    @endforeach
                                                    <th scope="col" class="text-center" rowspan="2">Nilai Raport</th>
                                                    <th scope="col" class="text-center" rowspan="2">Predikat</th>
            
                                                </tr>
                                                <tr>
            
                                                    @foreach ($practicebasecompetences as $basecompetence)
                                                        <th class="text-center">Kinerja Praktek</th>
                                                        <th class="text-center">Kinerja Produk</th>
                                                        <th class="text-center">Kinerja Proyek</th>
                                                        <th class="text-center">Skor</th>
                                                    @endforeach
            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sublevelstudents as $sublevelstudent)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            {{$sublevelstudent->nama}}
                                                        </td>
            
                                                        @php
                                                            $totalSum= 0;
                                                        @endphp
                                                        
                                                        @foreach ($practicebasecompetences as $basecompetence)
                                                            @php
                                                                $i = 0;
                                                                $sum[$loop->index] = 0;
                                                            @endphp
                                                            <td class="text-center">
                                                                @if (!is_object(practiceScore($sublevelstudent->student_id,$basecompetence->id)) || !practiceScore($sublevelstudent->student_id,$basecompetence->id)->praktek)
                                                                    0
                                                                @else
                                                                    {{practiceScore($sublevelstudent->student_id,$basecompetence->id)->praktek}}
                                                                    @php
                                                                        $sum[$loop->index] += practiceScore($sublevelstudent->student_id,$basecompetence->id)->praktek;
                                                                        $i++;
                                                                    @endphp
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if (!is_object(practiceScore($sublevelstudent->student_id,$basecompetence->id)) || !practiceScore($sublevelstudent->student_id,$basecompetence->id)->produk)
                                                                    0
                                                                @else
                                                                    {{practiceScore($sublevelstudent->student_id,$basecompetence->id)->produk}} 
                                                                    @php
                                                                        $sum[$loop->index] += practiceScore($sublevelstudent->student_id,$basecompetence->id)->produk;
                                                                        $i++;
                                                                    @endphp
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if (!is_object(practiceScore($sublevelstudent->student_id,$basecompetence->id)) || !practiceScore($sublevelstudent->student_id,$basecompetence->id)->proyek)
                                                                    0
                                                                @else
                                                                    {{practiceScore($sublevelstudent->student_id,$basecompetence->id)->proyek}}
                                                                    @php
                                                                        $sum[$loop->index] += practiceScore($sublevelstudent->student_id,$basecompetence->id)->proyek;
                                                                        $i++;
                                                                    @endphp
                                                                @endif
                                                            <td class="text-center">
                                                                @if ($i > 0)
                                                                    @php
                                                                        $totalSum += $sum[$loop->index]/$i;
                                                                    @endphp
                                                                    {{ round($sum[$loop->index]/$i) }}
                                                                @else
                                                                    0
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                        <td class="text-center">
                                                            @php
                                                                if (count($practicebasecompetences)>0) {
                                                                    $jumlahKD = count($practicebasecompetences);
                                                                    $totalRata = $totalSum/$jumlahKD;
                                                                }else{
                                                                    $totalRata = 0;
                                                                }
                                                                
                                                            @endphp
                                                            {{round($totalRata)}}
                                                        </td>
                                                        <td class="text-center">
                                                            @if (is_object(konversiNilai($totalRata,"nilai")))
                                                                {{konversiNilai($totalRata,"nilai")->nilai_huruf}}
                                                            @else
                                                                -
                                                            @endif
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
        </div><!-- /.container-fluid -->

        
        {{-- Form Modal Input --}}
        <div class="modal-input">
            <form action="" method="POST">    
                @csrf            
                <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="inputModalLabel">Tambah Kompetensi Dasar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="mata_pelajaran" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="mata_pelajaran" name="mata_pelajaran" readonly value="{{$levelsubject->subject->mata_pelajaran}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-8">
                                    <input class="form-control kode" id="kode" name="kode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kd" class="col-sm-4 col-form-label">Kompetensi Dasar</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control kd" id="kd" name="kd"></textarea>
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

        {{-- Form Modal edit --}}
        <div class="modal-edit">
            <form action="" method="POST">    
                @csrf            
                @method('patch')
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Kompetensi Dasar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="mata_pelajaran" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-8">
                                    <input class="form-control"name="mata_pelajaran" readonly value="{{$levelsubject->subject->mata_pelajaran}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-8">
                                    <input class="form-control edit-kode" name="kode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kd" class="col-sm-4 col-form-label">Kompetensi Dasar</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control edit-kd" name="kd"></textarea>
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

        {{-- Delete Confirmaation --}}
        <form method="POST" id="delete-form">
            @csrf
            @method('delete')
            <div class="modal fade" id="deletepayment" tabindex="-1" role="dialog" aria-labelledby="deletepaymentLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{asset('img/delete.png')}}" class="text-center" style="width: 50%;opacity: .5">
                            <p class="h4 mt-3"><strong>Apakah Anda Yakin Menghapus Data Ini?</strong></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

<script>
    

    window.addEventListener('load', async function(){

        $('.tambah').click(function(){

            let jumlah = $(this).data('jumlah');
            let nilai = jumlah+1;
            let id = $(this).data('id');
            let controller = $(this).data('controller');
            let subLevel = $(this).data('sublevel');

            controller == 'add-knowledge-competence' ? $('.kode').val(`3.${nilai}`) : $('.kode').val(`4.${nilai}`);
            $('.modal-input form').attr(`action`,`/levelsubject/${subLevel}/${id}/${controller}`);
            
        })

        $('.kd-delete').click(function(){
            let delete_id = $(this).data('id');
            let controller = $(this).data('controller');
            let subLevel = $(this).data('sublevel');
            
            const d = document.getElementById('delete-form');
            d.setAttribute("action",`/levelsubject/${subLevel}/${delete_id}/${controller}`);
        })
        
        $('.btn-edit-kd').click(function(){
            let id = $(this).data('id');
            let kd = $(this).data('kd');
            let kode = $(this).data('kode');         
            let controller = $(this).data('controller');
            let subLevel = $(this).data('sublevel');

            $('.edit-kode').val(kode);
            $('.edit-kd').val(kd);

            $('.modal-edit form').attr(`action`,`/levelsubject/${subLevel}/${id}/${controller}`);
        })

        $('#khowledge-table').DataTable();
        $('#practice-table').DataTable();
    })
    

</script>
    
@endsection