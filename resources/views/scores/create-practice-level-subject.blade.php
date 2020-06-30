@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Input Nilai {{$levelsubject->subject->mata_pelajaran}}
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
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="practice-table">
                                <thead class="table-warning">
                                    <tr>
                                        <th scope="col" class="text-center" rowspan="2" style="width: 2em">#</th>
                                        <th scope="col" class="text-center" rowspan="2">Nama</th>
                                        @foreach ($basecompetences as $basecompetence)
                                            <th scope="col" class="text-center"colspan="4">KD {{$basecompetence->kode}}</th>
                                        @endforeach
                                        <th scope="col" class="text-center" rowspan="2">Nilai Raport</th>
                                        <th scope="col" class="text-center" rowspan="2">Predikat</th>

                                        
                                    </tr>
                                    <tr>

                                        @foreach ($basecompetences as $basecompetence)
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
                                            
                                            @foreach ($basecompetences as $basecompetence)
                                                @php
                                                    $i = 0;
                                                    $sum[$loop->index] = 0;
                                                    
                                                    
                                                @endphp
                                                <td class="text-center">
                                                    @if (!is_object(practiceScore($sublevelstudent->id,$basecompetence->id)) || !practiceScore($sublevelstudent->id,$basecompetence->id)->praktek)
                                                        0
                                                    @else
                                                        {{practiceScore($sublevelstudent->id,$basecompetence->id)->praktek}}
                                                        @php
                                                            $sum[$loop->index] += practiceScore($sublevelstudent->id,$basecompetence->id)->praktek;
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                    <button 
                                                        class="btn btn-sm btn-link add-btn"
                                                        data-target="#tambahNilaiModal"
                                                        data-toggle="modal" 
                                                        data-studentid = "{{$sublevelstudent->student_id}}"
                                                        data-category = "praktek"
                                                        data-kd ="{{$basecompetence->id}}"
                                                        data-sublevel="{{$sublevel->id}}"
                                                        @if (is_object(practiceScore($sublevelstudent->id,$basecompetence->id)))
                                                            data-score ="{{practiceScore($sublevelstudent->id,$basecompetence->id)->praktek}}"
                                                        @endif

                                                        data-name =" {{$sublevelstudent->nama}}"
                                                        data-kode = "{{$basecompetence->kode}}"
                                                    ><i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    @if (!is_object(practiceScore($sublevelstudent->id,$basecompetence->id)) || !practiceScore($sublevelstudent->id,$basecompetence->id)->produk)
                                                        0
                                                    @else
                                                        {{practiceScore($sublevelstudent->id,$basecompetence->id)->produk}} 
                                                        @php
                                                            $sum[$loop->index] += practiceScore($sublevelstudent->id,$basecompetence->id)->produk;
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                    <button 
                                                        class="btn btn-sm btn-link add-btn"
                                                        data-target="#tambahNilaiModal"
                                                        data-toggle="modal" 
                                                        data-studentid = "{{$sublevelstudent->student_id}}"
                                                        data-category = "produk"
                                                        data-kd ="{{$basecompetence->id}}"
                                                        data-sublevel="{{$sublevel->id}}"
                                                        @if (is_object(practiceScore($sublevelstudent->id,$basecompetence->id)))
                                                            data-score ="{{practiceScore($sublevelstudent->id,$basecompetence->id)->produk}}"
                                                        @endif

                                                        data-name = "{{$sublevelstudent->nama}}"
                                                        data-kode = "{{$basecompetence->kode}}"
                                                    ><i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    @if (!is_object(practiceScore($sublevelstudent->id,$basecompetence->id)) || !practiceScore($sublevelstudent->id,$basecompetence->id)->proyek)
                                                        0
                                                    @else
                                                        {{practiceScore($sublevelstudent->id,$basecompetence->id)->proyek}}
                                                        @php
                                                            $sum[$loop->index] += practiceScore($sublevelstudent->id,$basecompetence->id)->proyek;
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                    <button 
                                                        class="btn btn-sm btn-link add-btn"
                                                        data-target="#tambahNilaiModal"
                                                        data-toggle="modal" 
                                                        data-studentid = "{{$sublevelstudent->student_id}}"
                                                        data-category = "proyek"
                                                        data-kd ="{{$basecompetence->id}}"
                                                        data-sublevel="{{$sublevel->id}}"
                                                        @if (is_object(practiceScore($sublevelstudent->id,$basecompetence->id)))
                                                            data-score ="{{practiceScore($sublevelstudent->id,$basecompetence->id)->proyek}}"
                                                        @endif

                                                        data-name = "{{$sublevelstudent->nama}}"
                                                        data-kode = "{{$basecompetence->kode}}"
                                                    ><i class="fas fa-edit"></i>
                                                    </button>
                                                <td class="text-center">
                                                    @if ($i)
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
                                                    $jumlahKD = count($basecompetences);
                                                    $totalRata = $totalSum/$jumlahKD;
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

                <div class="row mt-4">
                    <div class="col-sm-12">
                        <strong>Keterangan</strong> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <thead class="table-warning">
                                <tr>
                                    <th>KD</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basecompetences as $basecompetence)
                                    <tr>
                                        <td>{{$basecompetence->kode}}</td>
                                        <td>{{$basecompetence->keterampilan_kompetensi_dasar	}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal Tambah/Edit Nilai --}}
            <div class="modal-tambah">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahNilaiModal" tabindex="-1" role="dialog" aria-labelledby="#tambahNilaiModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title" id="#tambahNilaiModalLabel" ></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group row">
                                    <label for="kode" class="col-sm-3 col-form-label ">KD</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control kd" name="kd" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                                    <div class="col-sm-9 input-score">
                                        <input type="number" class="form-control score" name="" min="0" max="100">
                                        <small class="text-danger">Isi Nilai dengan Rentang 0 - 100</small>
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
        </section>
        <!-- /.content -->
    
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    const capitalize = (s) => {
        if (typeof s !== 'string') return '';
        return s.charAt(0).toUpperCase() + s.slice(1)
    }

    $('.add-btn').click(function(){

        let category = $(this).data('category');
        let kd = $(this).data('kd');
        let studentid = $(this).data('studentid');
        let sublevel = $(this).data('sublevel');

        console.log(studentid);
        

        let score = $(this).data('score');
        if (!score) score = 0 ; 
        
        let name = $(this).data('name');
        let kode = $(this).data('kode');

        
        $('.modal-title').text(`Isi Nilai Kinerja ${capitalize(category)}`);
        $('.kd').val(kode);
        $('.nama-siswa').val(name);
        
        $('.score').attr('name',category);

        $('.score').val(score);

        $('.modal-tambah form').attr(`action`,`/score/${sublevel}/${kd}/${studentid}/create-practice-score`);

    })

    $('#practice-table').DataTable();
})
</script>
    
@endsection
