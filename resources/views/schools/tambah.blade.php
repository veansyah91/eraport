@extends('layouts.main')

@section('content')    
    
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Tambah Data Sekolah
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
                    <div class="col-8">
                        <div id="app">

                            <form method="POST" action="/tambah-sekolah">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nss" class="col-sm-2 col-form-label">NSS</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nss" name="nss" placeholder="NSS">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="npsn" class="col-sm-2 col-form-label">NPSN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="npsn" name="npsn" placeholder="NPSN">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="desa" name="desa" placeholder="Desa">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="website" class="col-sm-2 col-form-label">Website</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select" id="status" name="status">
                                            <option selected><-- Pilih Status --></option>
                                            <option value="Negeri">Negeri</option>
                                            <option value="Swasta">Swasta</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row float-right">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary ">Tambah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        
@endsection
