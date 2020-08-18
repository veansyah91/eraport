@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Detail Pembayaran Uang Buku {{ $bookpayment->student->nama }}
                        </h1>
                    </div><!-- /.col -->          
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($bookpayment->jumlah > 0)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title font-weight-bolder">Bayar Buku</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="/buku/detail/{{ $bookpayment->id }}" method="POST">
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
                                            <input type="number" class="form-control text-right" id="jumlah" max="{{ $bookpayment->jumlah - $creditBookPayments->sum('jumlah') }}" min="0" name="jumlah" value="{{ $bookpayment->jumlah - $creditBookPayments->sum('jumlah') }}">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary float-right"
                                     @if ($bookpayment->jumlah - $creditBookPayments->sum('jumlah') == 0)
                                         disabled
                                     @endif
                                     type="submit">Bayar</button>
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
                                                : {{ $bookpayment->year->awal }}/{{ $bookpayment->year->akhir }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Nama 
                                            </td>
                                            <td>
                                                : {{ $bookpayment->student->nama }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Jumlah
                                            </td>
                                            <td>
                                                : Rp. {{ number_format($bookpayment->jumlah,0,",",".") }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%" class="font-weight-bolder">
                                                Sisa
                                            </td>
                                            <td>
                                                @if ($creditBookPayments->sum('jumlah') == $bookpayment->jumlah || $bookpayment->jumlah == 0)
                                                    : LUNAS
                                                @else
                                                    : Rp. {{ number_format($bookpayment->jumlah - $creditBookPayments->sum('jumlah'),0,",",".") }}
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if ($bookpayment->jumlah > 0)
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
                                                @foreach ($creditBookPayments as $creditBookPayment)
                                                    <tr>
                                                        <td>{{ $creditBookPayment->tanggal_bayar }}</td>
                                                        <td>Rp. {{ number_format($creditBookPayment->jumlah,0,",",".") }}</td>
                                                        <td>
                                                            <button 
                                                                class="btn btn-sm btn-danger" 
                                                                data-toggle="modal" 
                                                                data-target="#deletebookpayment" 
                                                                onclick="deleteBookPayment({{$creditBookPayment->id}})"
                                                            >hapus</button>
                                                        </td>
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
            <div class="modal fade" id="deletebookpayment" tabindex="-1" role="dialog" aria-labelledby="deletebookpaymentLabel" aria-hidden="true">
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

    const deleteBookPayment = (id) => {
        const d = document.getElementById('delete-form-payment');
        d.setAttribute("action",`/buku/detail/${id}`);
    }

    window.addEventListener('load', async function(){
        
    })
</script>
    
@endsection