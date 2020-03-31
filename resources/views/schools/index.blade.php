@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Data Sekolah
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
                          @if ($school->isEmpty())
                            <div>
                              <div class="_container">
                                <div class="row">
                                  <div class="col-12">
                                    <p class="h5 font-italic">Data Sekolah belum diisi</p>
                                  </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <a href="/tambah-sekolah" class="btn btn-primary btn-sm">
                                      <i class="fas fa-edit"></i> Tambah Data Sekolah
                                    </a>
                                  </div>
                              </div>
                            </div>
                          @else
                          <div>
                            <div class="_container">
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Sekolah</label>
                                    <div class="col-sm-9">
                                    <span class="form-control-plaintext">: {{$school[0]->nama_sekolah}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NSS</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->nss}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat Sekolah</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->alamat}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kelurahan/Desa</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->desa}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->kecamatan}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->kota}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->provinsi}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->website}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->email}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NPSN</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->npsn}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                      <span class="form-control-plaintext">: {{$school[0]->status}}</span>
                                    </div>
                                  </div>
                        
                                  <div class="form-group row float-right">
                                    <a href="/edit-sekolah" class="btn btn-primary btn-sm ">
                                      <i class="fas fa-edit"></i> Ubah Data Sekolah
                                    </a>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
     
@endsection
