@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3 class="m-0 text-dark">
                        Inventaris 
                    </h3>
                </div><!-- /.col -->          
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="{{ url('create-inventory-item') }}" class="btn btn-primary">
                            Tambah Inventaris
                        </a>
                    </div>
                </div>      

                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">No</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Item</th>
                                    <th colspan="2" class="text-center">Jumlah</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Baik</th>
                                    <th class="text-center">Rusak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($inventoryItems->isNotEmpty())
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($inventoryItems as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ $item->nama_item }}
                                            </td>
                                            <td class="text-center">
                                                {{ Inventory::goodInventoryItem($item->id) }}
                                                <button class="btn btn-sm btn-link edit-inventory" type="button" data-target="#editinventory" data-toggle="modal" data-id={{ $item->id }} data-condition='BAIK' data-jumlah='{{ Inventory::goodInventoryItem($item->id) }}'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                {{ Inventory::badInventoryItem($item->id) }}
                                                <button class="btn btn-sm btn-link edit-inventory" data-target="#editinventory" data-toggle="modal" data-id={{ $item->id }} data-condition='RUSAK' data-jumlah='{{ Inventory::badInventoryItem($item->id) }}'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                {{ Inventory::goodInventoryItem($item->id) + Inventory::badInventoryItem($item->id) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5">Inventori Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

        {{-- edit Confirmation --}}
        <form method="POST" id="edit-form" >
            @csrf
            @method('patch')
            <div class="modal fade" id="editinventory" tabindex="-1" role="dialog" aria-labelledby="editpaymentLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Jumlah Inventaris</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="condition">Kondisi</label>
                                <input type="text" class="form-control" id="condition" name="keterangan">
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection

@section('script')
<script type="text/javascript">
    window.addEventListener('load', function(){
        const editInventory = document.getElementsByClassName('edit-inventory')

        for (let index = 0; index < editInventory.length; index++) {           
            editInventory[index].addEventListener('click', () =>
                {
                    const modalEdit = document.getElementById('edit-form')
                    const conditionModal = document.getElementById('condition')
                    const jumlahModal = document.getElementById('jumlah')
                    
                    let jumlah = editInventory[index].getAttribute('data-jumlah')
                    let condition = editInventory[index].getAttribute('data-condition')

                    let idInventory = editInventory[index].getAttribute('data-id')

                    conditionModal.value = condition
                    jumlahModal.value = jumlah
                    modalEdit.setAttribute('action',`/store-inventory/id=${idInventory}`)
                }
            )
        }

    })
</script>
@endsection