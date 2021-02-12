@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
                <div class="row mb-4 ">
                    <div class="col-sm-12">
                            <a href="{{ url('/inventories') }}" class="btn btn-sm btn-success">Halaman Sebelumnya</a>
                        
                    </div><!-- /.col -->  
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h3 class="m-0 text-dark">
                            Input Inventaris
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
                    <div class="col-6">
                        <form action="/store-inventory-item" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nama_item">Nama Item</label>
                                <input type="text" class="form-control" id="nama_item" name='nama_item' placeholder="Nama Item">
                                @error('nama_item')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Tambah Inventaris</button>
                        </form>
                    </div>
                </div> 
                
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <table class="table">
                            <tbody>
                                @if ($inventoryItems->isNotEmpty())
                                    @foreach ($inventoryItems as $item)
                                    <tr>
                                        <td>
                                            {{ $item->nama_item }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger delete-inventory" type="button" data-target="#deleteinventory" data-toggle="modal" data-id={{ $item->id }}>Hapus</button>                                          
                                        </td>
                                    </tr> 
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <i>Item Inventaris Belum DItambahkan</i>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

        {{-- Delete Confirmation --}}
        <form method="POST" id="delete-form" >
            @csrf
            @method('delete')
            <div class="modal fade" id="deleteinventory" tabindex="-1" role="dialog" aria-labelledby="deletepaymentLabel" aria-hidden="true">
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
    window.addEventListener('load', function(){
        const deleteInventory = document.getElementsByClassName('delete-inventory')

        for (let index = 0; index < deleteInventory.length; index++) {           
            deleteInventory[index].addEventListener('click', () =>
                {
                    let idInventory = deleteInventory[index].getAttribute('data-id')
                    const modalDelete = document.getElementById('delete-form')
                    modalDelete.setAttribute('action',`/delete-inventory/id=${idInventory}`)
                }
            )
        }

    })
</script>
@endsection