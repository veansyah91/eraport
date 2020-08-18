@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Pembayaran Buku Pelajaran
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
                                    <th scope="col">Bayar</th>
                                    <th scope="col">Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->no_induk }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ Year::thisSemester()->year->awal }}/{{ Year::thisSemester()->year->akhir }}</td>
                                        <td>
                                            @if (BookPayment::getPayment($student->id, Year::thisSemester()->year_id))
                                                Rp. {{ number_format(BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->jumlah) }} <button onclick='editBuku({{ $student->id }}, "{{ $student->nama }}" ,{{ BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->jumlah }}, {{ Year::thisSemester()->year_id}})' class="btn-link btn btn-sm" data-toggle="modal" data-target="#entrypayment">ubah</button>
                                            @else
                                                <button class="btn btn-sm btn-primary add-payment" onclick='tambahBuku({{ $student->id }}, "{{ $student->nama }}" , {{ Year::thisSemester()->year_id}} )' data-toggle="modal" data-target="#entrypayment">Atur</button>
                                            @endif
                                        </td>
                                        <td>
                                            Rp.  
                                            @if (BookPayment::getPayment($student->id, Year::thisSemester()->year_id))
                                                {{ number_format(BookPayment::paymentAmount(BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->id),0,",",".") }}
                                                <a href="/buku/detail/{{ BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->id }}" class="btn btn-link btn-sm">detail</a>
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if (BookPayment::getPayment($student->id, Year::thisSemester()->year_id))
                                                @if (BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->jumlah - BookPayment::paymentAmount(BookPayment::getPayment($student->id, Year::thisSemester()->id)) == 0)
                                                    <span class="text-primary"><strong>LUNAS</strong></span> 
                                                @else 
                                                    Rp. {{ number_format(BookPayment::getPayment($student->id, Year::thisSemester()->year_id)->jumlah - BookPayment::paymentAmount(BookPayment::getPayment($student->id, Year::thisSemester()->id)),0,",",".") }}
                                                @endif
                                            @else
                                                <i>Harga Buku Belum Ditetapkan</i>
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
                                <label for="total">Harga Buku</label>
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
    const tambahBuku = (id, nama, year) =>{
        const entrypaymentLabel = document.getElementById('entrypaymentLabel');
        const f = document.getElementById('form-payment');

        entrypaymentLabel.innerText = `Input Biaya Buku ${nama}`;
        f.setAttribute("action",`/buku/${id}/${year}`);
    }


    const editBuku = (id,nama,total, year) =>{
        const entrypaymentLabel = document.getElementById('entrypaymentLabel');
        const f = document.getElementById('form-payment');
        const inputTotal = document.getElementById('total');

        inputTotal.value = total;

        entrypaymentLabel.innerText = `Edit Biaya Buku ${nama}`;
        f.setAttribute("action",`/buku/${id}/${year}`);
    }
    
    $(document).ready(async function ()
    {
        var table = $('#student-table').DataTable();
        
    })
</script>
    
@endsection