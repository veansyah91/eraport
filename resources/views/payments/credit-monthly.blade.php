@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Detail Pembayaran SPP {{ $monthlyPayment->student->nama }}
                        </h1>
                    </div><!-- /.col -->          
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($monthlyPayment->jumlah > 0)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title font-weight-bolder">Bayar SPP</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="/credit-monthly-payment/{{ $year->id }}/{{ $monthlyPayment->student_id }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label"></div>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control text-right" id="tanggal" name="tanggal" value="{{ Date("Y-m-d") }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-2 col-form-label">Rp</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control text-right" id="jumlah" name="jumlah" value="{{ $monthlyPayment->jumlah }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2 col-form-label"></div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control text-right" id="bulan" name="bulan" value="1">
                                        </div>
                                        <label for="bulan" class="col-sm-3 col-form-label" >Bulan</label>
                                    </div>
                                    <button class="btn btn-primary float-right" type="submit">Bayar</button>
                                </form>
                            </div>
                        </div>
                    <!-- /.card -->
                    </div>
                    @endif
                    

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Tahun Ajaran 
                                            </td>
                                            <td>
                                                : {{ $year->awal }}/{{ $year->akhir }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Nama 
                                            </td>
                                            <td>
                                                : {{ $monthlyPayment->student->nama }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Jumlah
                                            </td>
                                            <td>
                                                : Rp. {{ number_format($monthlyPayment->jumlah,0,",",".") }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Sisa
                                            </td>
                                            <td>
                                                @if (count($creditMonthlys) == 12 || $monthlyPayment->jumlah == 0)
                                                    : LUNAS
                                                @else
                                                    : {{ 12 - count($creditMonthlys) }} Bulan
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if ($monthlyPayment->jumlah > 0)
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title font-weight-bolder">Detail Pembayaran</h2>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jumlah</th>
                                                    <th>Bulan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creditMonthlys as $creditMonthly)
                                                    <tr>
                                                        <td>{{ $creditMonthly->tanggal_bayar }}</td>
                                                        <td>Rp. {{ number_format($creditMonthly->jumlah_bayar,0,",",".") }}</td>
                                                        <td>{{ bulanBayar($loop->iteration) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                <!-- /.card -->
                    </div>
                </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        {{-- Modal Delete Confirmation --}}
        <form method="POST" id="delete-form-payment">
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
@endsection

@section('script')
<script type="text/javascript">

const deleteCreditPayment = (id) => {
    const d = document.getElementById('delete-form-payment');
    d.setAttribute("action",`/credit-payment/${id}`);
}


window.addEventListener('load', async function(){
    
})
</script>
    
@endsection