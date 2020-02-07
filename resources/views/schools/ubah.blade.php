@extends('layouts.main')

@section('content')    
    
    <div class="content-wrapper">
        
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

                            <form method="POST" action="/edit-sekolah/{{$school[0]->id}}">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah" value="{{$school[0]->nama_sekolah}}">
                                        @error('nama_sekolah')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="nss" class="col-sm-2 col-form-label">NSS</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nss') is-invalid @enderror" id="nss" name="nss" placeholder="NSS" value="{{$school[0]->nss}}">
                                        @error('nss')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat" value="{{$school[0]->alamat}}">
                                        @error('alamat')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('desa') is-invalid @enderror" id="desa" name="desa" placeholder="Desa" value="{{$school[0]->desa}}">
                                        @error('desa')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="{{$school[0]->kecamatan}}">
                                        @error('kecamatan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" placeholder="Kota" value="{{$school[0]->kota}}">
                                        @error('kota')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" placeholder="Provinsi" value="{{$school[0]->provinsi}}">
                                        @error('provinsi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="website" class="col-sm-2 col-form-label">Website</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control  @error('website') is-invalid @enderror" id="website" name="website" placeholder="Website" value="{{$school[0]->website}}">
                                        @error('website')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{$school[0]->email}}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select" id="status" name="status">
                                            <option><-- Pilih Status --></option>
                                                <option value="Negeri" @if ($school[0]->status == "Negeri") selected @endif>Negeri</option>
                                                <option value="Swasta" @if ($school[0]->status == "Swasta") selected @endif>Swasta</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="npsn" class="col-sm-2 col-form-label">NPSN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="NPSN" value="{{$school[0]->npsn}}">
                                        @error('npsn')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row float-right">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary ">Ubah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        </div>
        
@endsection
