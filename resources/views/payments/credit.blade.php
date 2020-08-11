@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Detail Pembayaran PSB {{ $entryPayment->student->nama }}
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
                    <div class="col-sm-6">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width:25%">
                                    Nama 
                                </td>
                                <td>
                                    : {{ $entryPayment->student->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:25%">
                                    Jumlah
                                </td>
                                <td>
                                    : Rp. {{ number_format($entryPayment->total,0,",",".") }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:25%">
                                    Sisa
                                </td>
                                <td>
                                    @if ($entryPayment->total - $jumlahbayar == 0)
                                        : <span class="text-primary"><strong>LUNAS</strong></span>
                                    @else 
                                        : Rp. {{ number_format($entryPayment->total - $jumlahbayar,0,",",".") }}
                                    @endif
                                    
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        @if ($entryPayment->total - $jumlahbayar != 0)
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Bayar PSB</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form method="POST" action="/credit-payment/{{ $entryPayment->student_id }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" placeholder="Tanggal" value="{{ Date("Y-m-d") }}" name="tanggal_bayar">
                                </div>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah_bayar" value="{{ $entryPayment->total - $jumlahbayar }}" min="100000" max="{{ $entryPayment->total - $jumlahbayar }}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endif
        

        <section class="content ">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <table class="table table-hover display responsive nowrap student-table" id="student-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tanggal Bayar</th>
                                    <th scope="col" class="text-center">Jumlah Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($creditPayments as $creditPayment)
                                <tr>
                                    <td scope="col" class="text-center">{{ $creditPayment->tanggal_bayar }}</td>
                                    <td scope="col" class="text-center">Rp. {{ number_format($creditPayment->jumlah_bayar,0,",",".") }}</td>
                                    <td scope="col" class="text-center">
                                        <button class="btn btn-sm btn-danger" 
                                         data-toggle="modal" 
                                         data-target="#deletepayment"
                                         onclick="deleteCreditPayment({{$creditPayment->id}})"
                                        >
                                            hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>     
            </div>
        </section>
        <!-- /.content -->
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