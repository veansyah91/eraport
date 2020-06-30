@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Pengaturan Konversi dan Persentase Nilai
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
                    <div class="col-6">
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    @if ($converts->isEmpty())
                                        <form method="POST" action="/add-converts">
                                            @csrf
                                            <table class="table" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">Nilai Terbesar</th>
                                                        <th scope="col" class="text-center">Nilai Terkecil</th>
                                                        <th scope="col" class="text-center">Predikat</th>
                                                        <th scope="col" class="text-center">Penjelasan</th>
                                                        <th scope="col"  class="text-center">Nilai Huruf</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td >
                                                            <input type="text" value="100" class="text-center form-control" readonly name="nb[0]"style="width: 4em" >                                                        
                                                        </td>
                                                        <td >
                                                            <input type="number" name="nk[0]" 
                                                            class=" form-control nk0 text-center "
                                                            style="width: 4em">
                                                            
                                                        </td>
                                                        <td >
                                                            <input type="text" name="predikat[0]" class="predikat0 text-center form-control"readonly value="4"style="width: 4em">
                                                        </td>
                                                        <td >
                                                            <input 
                                                            type="text" 
                                                            name="penjelasan[0]" 
                                                            class="  text-center form-control penjelasan0" 
                                                            style="width: 9em"
                                                            >
                                                        </td>
                                                        <td ><input type="text" name="nilaihuruf[0]" class="text-center form-control" style="width: 4em" value="A" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <input type="text" name="nb[1]" class="nb1 text-center form-control" readonly style="width: 4em">
                                                        </td>
                                                        <td >
                                                            <input type="number" name="nk[1]" class=" nk1 text-center form-control" style="width: 4em">
                                                        </td>
                                                        <td >
                                                            <input type="text" name="predikat[1]" class="predikat1 text-center form-control" readonly value="3"style="width: 4em">
                                                        </td>
                                                        <td >
                                                            <input type="text" name="penjelasan[1]" class=" text-center form-control penjelasan1" style="width: 9em">
                                                        </td>
                                                        <td >
                                                            <input type="text" name="nilaihuruf[1]" class="text-center form-control" style="width: 4em" value="B" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td ><input type="text" name="nb[2]" class="nb2 text-center form-control" readonly style="width: 4em"></td>
                                                        <td ><input type="number" name="nk[2]" class="nk2 text-center form-control"style="width: 4em"></td>
                                                        <td ><input type="text" name="predikat[2]" class="predikat2 text-center form-control" readonly value="2"style="width: 4em"></td>
                                                        <td ><input type="text" name="penjelasan[2]"  style="width: 9em" class="text-center form-control penjelasan2"></td>
                                                        <td ><input type="text" name="nilaihuruf[2]" class="text-center form-control" style="width: 4em" value="C" readonly></td>
                                                    </tr><tr>
                                                        <td ><input type="text" name="nb[3]" class="nb3 text-center form-control" readonly style="width: 4em"></td>
                                                        <td ><input type="number" value="0" readonly name="nk[3]" class="text-center form-control" style="width: 4em"></td>
                                                        <td ><input type="text" name="predikat[3]" class="predikat3 text-center form-control" readonly value="1"style="width: 4em"></td>
                                                        <td ><input type="text" name="penjelasan[3]"style="width: 9em" class="text-center form-control penjelasan3"></td>
                                                        <td ><input type="text" name="nilaihuruf[3]" class="text-center form-control" style="width: 4em" value="D" readonly></td>
                                                    </tr>
                                                    </tr><tr>
                                                        <td colspan="5">
                                                            <button type="submit" class="btn btn-primary btn-sm btn-submit" id="btn-submit" disabled>Simpan</button>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                        </form>
                                    @else
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">Nilai Terbesar</th>
                                                    <th scope="col" class="text-center">Nilai Terkecil</th>
                                                    <th scope="col" class="text-center">Predikat</th>
                                                    <th scope="col" class="text-center">Penjelasan</th>
                                                    <th scope="col"  class="text-center">Nilai Huruf</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($converts as $convert)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$convert->nilai_atas}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$convert->nilai_bawah}}
                                                    </td class="text-center">
                                                    <td class="text-center">
                                                        {{$convert->predikat}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$convert->penjelasan}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$convert->nilai_huruf}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            
                                        </table>
                                    @endif
                                </div>
                                
                            </div>
                            @if ($converts->isNotEmpty())
                                <div class="row">
                                    <div class="col-sm-6 float-right">
                                        <button class="btn btn-success btn-sm " data-toggle="modal"  
                                        data-target="#convertEditModal" >Ubah</button>
                                    </div>
                                </div>
                            @endif
                        </div>                     
                        

                    </div>

                    <div class="col-sm-6">
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    @if ($scores->isEmpty())
                                        <p><i>Persentase Nilai Belum Diatur</i></p>
                                        <a href="{{route('addscore')}}" class="btn btn-primary btn-sm">Atur secara default</a>
                                    @else
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-left">Periode</th>
                                                    <th scope="col" class="text-left">Persen</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($scores as $score)
                                                    <tr>
                                                        <td class="text-left ">
                                                            <p class="period">{{ $score->period }}</p>
                                                            
                                                        </td>
                                                        <td class="text-left ">
                                                            <p class="percent">{{ $score->percent }} %</p> 
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                                
                                            </tbody>
                                            
                                        </table>
                                    @endif
                                </div>
                                
                            </div>
                            @if ($scores)
                                <div class="row">
                                    <div class="col-sm-6 float-right">
                                        <button class="btn btn-success btn-sm edit-score" id="edit-score" data-toggle="modal"  
                                        data-target="#percentScoreModal" >Ubah</button>
                                    </div>
                                </div>
                            @endif
                            
                        </div>                     
                        

                    </div>
                </div>            
        
            </div>
        </section>
        <!-- /.content -->

        {{-- Modal--}}
        {{-- Edit Convert --}}
        <div class="modal-edit">
            <form method="post" action="/edit-converts" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal fade" id="convertEditModal" tabindex="-1" role="dialog" aria-labelledby="convertEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="convertEditModalLabel">Edit Konversi Nilai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">                                    
                                    <table class="table" >
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Nilai Terbesar</th>
                                                <th scope="col" class="text-center">Nilai Terkecil</th>
                                                <th scope="col" class="text-center">Predikat</th>
                                                <th scope="col" class="text-center">Penjelasan</th>
                                                <th scope="col"  class="text-center">Nilai Huruf</th>
                                            </tr>
                                        </thead>
                                        @if ($converts->isNotEmpty())
                                        <tbody>
                                            <tr>
                                                <td >
                                                    <input type="text" hidden name="id[0]" value="{{ $converts[0]->id }}">
                                                    <input type="text" value="100" class="text-center form-control" readonly name="nb[0]"style="width: 4em" >                                                        
                                                </td>
                                                <td >
                                                    <input type="number" name="nk[0]" 
                                                    class=" form-control nk0 text-center "
                                                    style="width: 4em" value="{{ $converts[0]->nilai_bawah }}">
                                                    
                                                </td>
                                                <td >
                                                    <input type="text" name="predikat[0]" class="predikat0 text-center form-control"readonly value="4"style="width: 4em">
                                                </td>
                                                <td >
                                                    <input 
                                                    type="text" 
                                                    name="penjelasan[0]" 
                                                    class="  text-center form-control penjelasan0" 
                                                    style="width: 9em"
                                                    value="{{ $converts[0]->penjelasan }}"
                                                    >
                                                </td>
                                                <td ><input type="text" name="nilaihuruf[0]" class="text-center form-control" style="width: 4em" value="A" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    <input type="text" hidden value="{{ $converts[1]->id }}" name="id[1]">
                                                    <input type="text" name="nb[1]" class="nb1 text-center form-control" readonly style="width: 4em" value="{{ $converts[1]->nilai_atas }}">
                                                </td>
                                                <td >
                                                    <input type="number" name="nk[1]" class=" nk1 text-center form-control" style="width: 4em" value="{{ $converts[1]->nilai_bawah }}">
                                                </td>
                                                <td >
                                                    <input type="text" name="predikat[1]" class="predikat1 text-center form-control" readonly value="3"style="width: 4em">
                                                </td>
                                                <td >
                                                    <input type="text" name="penjelasan[1]" class=" text-center form-control penjelasan1" style="width: 9em" value="{{ $converts[1]->penjelasan }}">
                                                </td>
                                                <td >
                                                    <input type="text" name="nilaihuruf[1]" class="text-center form-control" style="width: 4em" value="B" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="text" hidden value="{{ $converts[2]->id }}" name="id[2]">
                                                <td ><input type="text" name="nb[2]" class="nb2 text-center form-control" readonly style="width: 4em" value="{{ $converts[2]->nilai_atas }}"></td>
                                                <td ><input type="number" name="nk[2]" class="nk2 text-center form-control"style="width: 4em" value="{{ $converts[2]->nilai_bawah }}"></td>
                                                <td ><input type="text" name="predikat[2]" class="predikat2 text-center form-control" readonly value="2"style="width: 4em"></td>
                                                <td ><input type="text" name="penjelasan[2]"  style="width: 9em" class="text-center form-control penjelasan2" value="{{ $converts[2]->penjelasan }}"></td>
                                                <td ><input type="text" name="nilaihuruf[2]" class="text-center form-control" style="width: 4em" value="C" readonly></td>
                                            </tr>
                                            <tr>
                                                <input type="text" hidden value="{{ $converts[3]->id }}" name="id[3]">
                                                <td ><input type="text" name="nb[3]" class="nb3 text-center form-control" readonly style="width: 4em" value="{{ $converts[3]->nilai_atas }}"></td>
                                                <td ><input type="number" value="0" readonly name="nk[3]" class="text-center form-control" style="width: 4em"></td>
                                                <td ><input type="text" name="predikat[3]" class="predikat3 text-center form-control" readonly value="1"style="width: 4em"></td>
                                                <td ><input type="text" name="penjelasan[3]"style="width: 9em" class="text-center form-control penjelasan3" value="{{ $converts[3]->penjelasan }}"></td>
                                                <td ><input type="text" name="nilaihuruf[3]" class="text-center form-control" style="width: 4em" value="D" readonly></td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                        @endif
                                        
                                        
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        {{-- Edit Percent Score --}}
        <div class="modal-edit">
            <form method="POST" action="{{ route('editscore') }}">
                @csrf
                @method('patch')
                <div class="modal fade" id="percentScoreModal" tabindex="-1" role="dialog" aria-labelledby="percentScoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="percentScoreModalLabel">Ubah Persentase Nilai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $i = 0;
                                @endphp
                                @if ($scores)
                                    @foreach ($scores as $score)
                                    <div class="form-group row">
                                        <label for="harian" class="col-sm-5 col-form-label period-edit">{{$score->period}}</label>
                                        <input type="text" hidden value="{{$score->id}}" name="id[{{$i}}]">
                                        <div class="col-sm-5">
                                            <input type="number" class="form-control percent-edit" name="percent[{{$i++}}]" value="{{$score->percent}}">
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('script')
<script type="text/javascript">
function cekData(){
    if( $('.nk0').val()&&$('.nk1').val()&&$('.nk2').val()&&$('.penjelasan0').val()&&$('.penjelasan1').val()&&$('.penjelasan2').val()&&$('.penjelasan3').val() ){
        $(".btn-submit").removeAttr('disabled');
    }else{
        $("#btn-submit").attr("disabled","disabled");
    }
}

$('document').ready(function(){    

    $('.nk0').on({
        change: function(){
            let nilai = parseInt($('.nk0').val());
            nilai ? $('.nb1').val(nilai-1): $('.nb1').val(0);
            cekData();
        },
        keyup: function(){
            let nilai = parseInt($('.nk0').val());
            nilai ? $('.nb1').val(nilai-1): $('.nb1').val(0);
            cekData();
        }
    })

    $('.nk1').on({
        change: function(){
            let nilai = parseInt($('.nk1').val());
            nilai ? $('.nb2').val(nilai-1): $('.nb2').val(0);
            cekData();
        },
        keyup: function(){
            let nilai = parseInt($('.nk1').val());
            nilai ? $('.nb2').val(nilai-1): $('.nb2').val(0);
            cekData();
        }
    })

    $('.nk2').on({
        change: function(){
            let nilai = parseInt($('.nk2').val());
            nilai ? $('.nb3').val(nilai-1): $('.nb3').val(0);
            cekData(); 
        },
        keyup: function(){
            let nilai = parseInt($('.nk2').val());
            nilai ? $('.nb3').val(nilai-1): $('.nb3').val(0);
            cekData();
        }
    })

    $('.penjelasan0').on({
        change: function(){
            cekData(); 
        },
        keyup: function(){
            cekData();
        }
    })

    $('.penjelasan1').on({
        change: function(){
            cekData(); 
        },
        keyup: function(){
            cekData();
        }
    })

    $('.penjelasan2').on({
        change: function(){
            cekData(); 
        },
        keyup: function(){
            cekData();
        }
    })

    $('.penjelasan3').on({
        change: function(){
            cekData(); 
        },
        keyup: function(){
            cekData();
        }
    })

    

    let editScore = document.getElementById('edit-score');
    editScore.addEventListener("click", function(){
        let editPeriod = document.getElementsByClassName('period-edit');
        let editPercent = document.getElementsByClassName('percent-edit');    
        
        editPercent[0].addEventListener("change",function(){
            let harian = editPercent[0].value;
            let sisa = (100-harian)/2;

            editPercent[1].value = sisa;
            editPercent[2].value = sisa;            
        })

        editPercent[0].addEventListener("keyup",function(){
            let harian = editPercent[0].value;
            let sisa = (100-harian)/2;
            editPercent[1].value = sisa;
            editPercent[2].value = sisa;            
        })

        editPercent[1].addEventListener("change",function(){
            let uts = editPercent[1].value;
            let harian = editPercent[0].value;
            let sisa = 100-harian-uts;

            editPercent[2].value = sisa;                 
        })

        editPercent[1].addEventListener("keyup",function(){
            let uts = editPercent[1].value;
            let harian = editPercent[0].value;
            let sisa = 100-harian-uts;           
            
            editPercent[2].value = sisa;            
        })
        
        
        
    })

})
    

</script>
@endsection