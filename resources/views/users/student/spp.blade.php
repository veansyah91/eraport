@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pembayaran SPP {{ Auth::user()->student->nama }}</h1>
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
                                    Tahun Ajaran
                                </td>
                                <td>
                                    : {{ $year->awal }}/{{ $year->akhir }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:40%" class="font-weight-bolder">
                                    Jumlah
                                </td>
                                <td>
                                    : Rp. {{ number_format($monthlyPayment->jumlah,0,",",".") }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:40%" class="font-weight-bolder">
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
                                    <th>
                                        Bulan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($creditMonthlys as $creditMonthly)
                                    <tr class="text-center">
                                        <td>{{ $creditMonthly->tanggal_bayar }}</td>
                                        <td>Rp. {{ number_format($creditMonthly->jumlah_bayar,0,",",".") }}</td>
                                        <td>{{ bulanBayar($loop->iteration) }}</td>
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