@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pembayaran PSB {{ Auth::user()->student->nama }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width:40%" class="font-weight-bolder">
                                    Jumlah
                                </td>
                                <td>
                                    : Rp. {{ number_format($entryPayment->total,0,",",".") }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:40%" class="font-weight-bolder">
                                    Sisa
                                </td>
                                <td>
                                    @php
                                        $total = 0;
                                        foreach($creditPayments as $creditPayment){
                                            $total += $creditPayment->jumlah_bayar;
                                        }
                                    @endphp
                                    : @if ($entryPayment->total - $total > 0)
                                        Rp. {{ $entryPayment->total - $total }}
                                    @else
                                        LUNAS
                                    @endif 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-8">
                    <div class="card card-body">
                        <table class="table">
                            <thead>                                
                                <tr class="text-center">
                                    <th>
                                        Tanggal
                                    </th>
                                    <th>
                                        Jumlah
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($creditPayments as $creditPayment)
                                    <tr class="text-center">
                                        <td>{{ $creditPayment->tanggal_bayar }}</td>
                                        <td>Rp. {{ number_format($creditPayment->jumlah_bayar,0,",",".") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
                
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(async function(){
    
})
    

</script>
    
@endsection