@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Pembayaran SPP
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
                    <div class="col-12">
                        <table class="table table-hover display responsive nowrap student-table" id="student-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor Induk</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Bayar (Bulan)</th>
                                    <th scope="col">Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->no_induk }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $year->awal }}/{{ $year->akhir }}</td>
                                        <td>
                                            @if (monthlyPayment($student->id))
                                                Rp. {{ number_format(monthlyPayment($student->id)->jumlah,0,",",".") }} <button onclick='editPSB({{ $student->id }}, "{{ $student->nama }}" ,{{ monthlyPayment($student->id)->total }})' class="btn-link btn btn-sm" data-toggle="modal" data-target="#entrypayment">ubah</button>
                                            @else
                                                <button class="btn btn-sm btn-primary add-payment" onclick='tambahPSB({{ $student->id }}, "{{ $student->nama }}")' data-toggle="modal" data-target="#entrypayment">Atur</button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ count(creditMonthlyPayment($student->id,$year->id)) }} bulan <a href="/credit-monthly-payment/{{ $year->id }}/{{ $student->id }}" class="btn btn-link btn-sm">detail</a>
                                        </td>
                                        <td>
                                            @if (entryPayment($student->id)->total - creditPayment($student->id) == 0)
                                                <span class="text-primary"><strong>LUNAS</strong></span> 
                                            @else 
                                                Rp. {{ number_format(entryPayment($student->id)->total - creditPayment($student->id),0,",",".") }}
                                            @endif
                                            
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
        
        <!-- Modal -->
        <form method="POST" id="form-payment">
            @csrf
            @method('patch')
            <div class="modal fade" id="entrypayment" tabindex="-1" role="dialog" aria-labelledby="entrypaymentLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="entrypaymentLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="total">Jumlah SPP</label>
                                <input type="number" class="form-control" id="total" name="total">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection

@section('script')
<script type="text/javascript">
    const tambahPSB = (id, nama) =>{
        const entrypaymentLabel = document.getElementById('entrypaymentLabel');
        const f = document.getElementById('form-payment');

        entrypaymentLabel.innerText = `Input Biaya SPP ${nama}`;
        f.setAttribute("action",`/spp/${id}`);
    }


    const editPSB = (id,nama,total) =>{
        const entrypaymentLabel = document.getElementById('entrypaymentLabel');
        const f = document.getElementById('form-payment');
        const inputTotal = document.getElementById('total');

        inputTotal.value = total;

        entrypaymentLabel.innerText = `Edit Biaya SPP ${nama}`;
        f.setAttribute("action",`/spp/${id}`);
    }
    $(document).ready(async function ()
    {
        var table = $('#student-table').DataTable();
        
    })
</script>
    
@endsection