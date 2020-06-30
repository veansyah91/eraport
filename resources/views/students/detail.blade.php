@extends('layouts.main')

@section('content')
        
        <!-- Main content -->
        <section class="content ">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-3 ">
                        
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                @if ($student->image)
                                
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('img/student/'.$student->image)}}" alt="User profile picture">
                                </div>
                                @else
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('img/user.png')}}" alt="User profile picture">
                                </div>
                                @endif
                                
            
                                <h3 class="profile-username text-center">{{$student->nama}}</h3>
                                <table class="table table-responsive table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Nomor Induk</td>
                                            <td>: {{$student->no_induk}}</td>
                                        </tr>   
                                        <tr>
                                            <td>NISN</td>
                                            <td>: {{$student->nisn}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button class="btn btn-success btn-sm float-right "data-toggle="modal" data-target="#UbahProfilSiswaModalCenter" >Ubah Profil Siswa</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
            
                        <!-- biodata -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Biodata</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>Tempat Lahir: </strong>
                
                                <p class="text-muted">
                                    {{$student->tempat_lahir}}
                                </p>
                
                                <hr>
                                
                                <strong>Tanggal Lahir: </strong>
                
                                <p class="text-muted">
                                    {{date('d F Y', strtotime($student->tgl_lahir)) }}
                                </p>
                
                                <hr>

                                <strong>Jenis Kelamin: </strong>
                                <p class="text-muted">
                                    {{$student->jenis_kelamin}}
                                </p>
                
                                <hr>

                                <strong>Tinggi Badan (cm): </strong>
                                <p class="text-muted">
                                    {{$student->tinggi_badan}}
                                </p>
                
                                <hr>

                                <strong>Berat Badan (kg): </strong>
                                <p class="text-muted">
                                    {{$student->berat_badan}}
                                </p>
                
                                <hr>

                                <strong>Agama: </strong>
                                <p class="text-muted">
                                    {{$student->agama}}
                                </p>
                
                                <hr>

                                <strong>Anak Ke-: </strong>
                                <p class="text-muted">
                                    {{$student->anak_ke}}
                                </p>
                
                                <hr>

                                <strong>Hobi: </strong>
                                <p class="text-muted">
                                    {{$student->hobi}}
                                </p>
                
                                <hr>
                                <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#UbahBiodataSiswaModalCenter">Ubah Biodata</button>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- biodata orang tua-->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Biodata Orang Tua</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>Nama Ayah: </strong>
                
                                <p class="text-muted">
                                    {{$student->nama_ayah}}
                                </p>
                
                                <hr>
                                
                                <strong>Nama Ibu: </strong>
                
                                <p class="text-muted">
                                    {{$student->nama_ibu}}
                                </p>
                
                                <hr>

                                <strong>Pekerjaan Ayah: </strong>
                                <p class="text-muted">
                                    {{$student->pekerjaan_ayah}}
                                </p>
                
                                <hr>

                                <strong>Pekerjaan Ibu: </strong>
                                <p class="text-muted">
                                    {{$student->pekerjaan_ibu}}
                                </p>
                
                                <hr>

                                <strong>Pendidikan Ayah: </strong>
                                <p class="text-muted">
                                    {{$student->pendidikan_ayah}}
                                </p>
                
                                <hr>

                                <strong>Pendidikan Ibu: </strong>
                                <p class="text-muted">
                                    {{$student->pendidikan_ibu}}
                                </p>
                
                                <hr>
                                <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#UbahBiodataOrangtuaModalCenter">Ubah Biodata Orang Tua</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- biodata alamat-->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Alamat Lengkap</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>Jalan: </strong>
                
                                <p class="text-muted">
                                    {{$student->jalan}}
                                </p>
                
                                <hr>
                                
                                <strong>Desa/Kelurahan: </strong>
                
                                <p class="text-muted desa">{{$student->desa}}</p>
                
                                <hr>

                                <strong>Kecamatan: </strong>
                                <p class="text-muted kecamatan">{{$student->kecamatan}}</p>
                
                                <hr>

                                <strong>Kabupaten/Kota: </strong>
                                <p class="text-muted kabupaten">{{$student->kabupaten}}</p>
                
                                <hr>

                                <strong>Provinsi: </strong>
                                <p class="text-muted provinsi">{{$student->provinsi}}</p>
                
                                <hr>

                                <strong>Kode Pos: </strong>
                                <p class="text-muted">
                                    {{$student->kode_pos}}
                                </p>

                                <strong>Jarak Rumah Ke Sekolah (km): </strong>
                                <p class="text-muted">
                                    {{$student->jarak_rumah}}
                                </p>
                
                                <hr>
                                <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#UbahAlamatModalCenter">Ubah Alamat</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    
                                    @foreach ($levelsudents as $levelsudent)
                                        @php
                                            $kelassekarang = '';
                                            if ($levelsudent->year_id == $year->id) {
                                                $kelassekarang = $levelsudent->kelas;
                                            }
                                        @endphp
                                        
                                            
                                        
                                        <li class="nav-item">
                                            <a class="nav-link 
                                                @if($levelsudent->year_id == $year->id) 
                                                    active 
                                                @endif" 
                                                href="#kelas{{$levelsudent->id}}" data-toggle="tab">
                                                    Kelas {{$levelsudent->kelas}}
                                            </a>
                                        </li>
                                        
                                    @endforeach
                                    <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Riwayat Sekolah</a></li>
                                </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach ($levelsudents as $levelsudent)
                                            <div class="tab-pane 
                                                @if($levelsudent->year_id == $year->id) 
                                                    active 
                                                @endif" 
                                                id="kelas{{$levelsudent->id}}">

                                                <div class="post">
                                                    <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                        <a href="#">Jonathan Burke Jr.</a>
                                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore the hate as they create awesome
                                                    tools to help create filler text for everyone from bacon lovers
                                                    to Charlie Sheen fans.
                                                    </p>
                            
                                                    <p>
                                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                                    <span class="float-right">
                                                        <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                        </a>
                                                    </span>
                                                    </p>
                            
                                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                                </div>
                                                <!-- /.post -->
                                            </div>
                                        @endforeach

                                        {{-- History --}}
                                        <div class="tab-pane" id="history">
                                            <!-- Post -->
                                                <div class="post">
                                                    <table class="table table-responsive table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Sekolah Sebelumnya</td>
                                                                <td>: {{$student->sekolah_sebelumnya}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tahun Masuk Sekolah</td>
                                                                <td>: {{$student->tahun_masuk}}</td>
                                                            </tr>   
                                                            <tr>
                                                                <td>Masuk Kelas</td>
                                                                <td>: {{$student->kelas}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kelas Tahun Ini</td>
                                                                <td>: {{$kelassekarang}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#UbahRiwayatSekolahModalCenter">Ubah Riwayat Sekolah</button>
                                                </div>
                                                <!-- /.post -->
                                            </div>
                                    </div>
                                <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                        <!-- /.nav-tabs-custom -->
                        </div>
                    <!-- /.col -->
                </div>
            </div>

            
        </section>
        <!-- /.content -->
        
        
        
        
        {{-- Modal Edit Profil Siswa --}}
        <div class="edit-profil-siswa">
            <form method="post" action="/student/{{$student->id}}/editprofilsiswa" enctype="multipart/form-data">
                <div class="modal fade" id="UbahProfilSiswaModalCenter" tabindex="-1" role="dialog" aria-labelledby="UbahProfilSiswaModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="UbahProfilSiswaModalCenterTitle">Ubah Profil Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                                @csrf
                                @method('patch')
                                <div class="text-center form-group row">
                                    <div class="body-image">
                                        <img class="img-fluid img-thumbnail" 
                                        @if ($student->image)
                                            src="{{asset('img/student/'.$student->image)}}" 
                                        @else
                                            src="{{asset('img/user.png')}}" 
                                        @endif
                                        
                                        
                                        alt="User profile picture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="button" class="btn btn-success btn-sm edit-foto md-2" data-id="{{$student->image}}">Ubah Foto</button>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$student->nama}}">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{$student->nik}}">
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="no_induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="no_induk" placeholder="Nomor Induk" value="{{$student->no_induk}}">
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nisn" placeholder="NISN" value="{{$student->nisn}}">
                                        @error('nisn')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Edit Biodata Siswa --}}
        <div class="edit-biodata-siswa">
            <form method="post" action="/student/{{$student->id}}/editbiodatasiswa" enctype="multipart/form-data">
                <div class="modal fade" id="UbahBiodataSiswaModalCenter" tabindex="-1" role="dialog" aria-labelledby="UbahBiodataSiswaModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="UbahBiodataSiswaModalCenterTitle">Ubah Biodata Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{$student->tempat_lahir}}">
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{$student->tgl_lahir}}">
                                        @error('tgl_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" value="{{$student->jenis_kelamin}}">
                                            <option value=""><-- Pilih Jenis Kelamin --></option>
                                            <option value="Laki-Laki" @if ($student->jenis_kelamin == "Laki-Laki")
                                                selected
                                            @endif>Laki-Laki</option>
                                            <option value="Perempuan" @if ($student->jenis_kelamin == "Perempuan")
                                                selected
                                            @endif>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="tinggi_badan" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" value="{{$student->tinggi_badan}}">
                                        @error('tinggi_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="berat_badan" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="berat_badan" name="berat_badan" placeholder="Berat Badan" value="{{$student->berat_badan}}">
                                        @error('berat_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="hobi" class="col-sm-3 col-form-label">Hobi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="hobi" name="hobi" placeholder="Hobi" value="{{$student->hobi}}">
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="agama" class="col-sm-3 col-form-label">Agama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama" value="{{$student->agama}}">
                                        @error('agama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="anak_ke" class="col-sm-3 col-form-label">Anak ke-<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="{{$student->anak_ke}}">
                                        @error('anak_ke')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Edit Biodata Orang Tua --}}
        <div class="edit-biodata-orangtua">
            <form method="post" action="/student/{{$student->id}}/editbiodataorangtua" enctype="multipart/form-data">
                <div class="modal fade" id="UbahBiodataOrangtuaModalCenter" tabindex="-1" role="dialog" aria-labelledby="UbahBiodataOrangtuaModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="UbahBiodataOrangtuaModalCenterTitle">Ubah Biodata Orangtua</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                @method('patch')
                                
                                <div class="form-group row">
                                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" value="{{$student->nama_ayah}}">
                                        @error('nama_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="{{$student->nama_ibu}}">
                                        @error('nama_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="{{$student->pekerjaan_ayah}}">
                                        @error('pekerjaan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="{{$student->pekerjaan_ibu}}">
                                        @error('pekerjaan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" placeholder="Pendidikan Ayah" value="{{$student->pendidikan_ayah}}">
                                        @error('pendidikan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" placeholder="Pendidikan Ibu" value="{{$student->pendidikan_ibu}}">
                                        @error('pendidikan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Edit Alamat --}}
        <div class="edit-biodata-orangtua">
            <form method="post" action="/student/{{$student->id}}/editalamat" enctype="multipart/form-data">
                <div class="modal fade" id="UbahAlamatModalCenter" tabindex="-1" role="dialog" aria-labelledby="UbahAlamatModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="UbahAlamatModalCenterTitle">Ubah Biodata Orangtua</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                @method('patch')
                                
                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
                                            <option value="" selected><-- Pilih Provinsi --></option>
                                            <div class="body-provinsi">
                                                
                                            </div>                                            
                                        </select>
                                        @error('provinsi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kabupaten" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
                                            <option value="" selected><-- Pilih Kabupaten --></option>
                                            <div id="body-kabupaten">

                                            </div>
                                        </select>
                                        @error('kabupaten')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-9 body-kecamatan">
                                        <select class="custom-select" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                                            <option value="" selected><-- Pilih Kecamatan --></option>
                                        </select>
                                        @error('kecamatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="desa" class="col-sm-3 col-form-label">Desa</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="desa" name="desa" value="{{ old('desa') }}">
                                            <option value="" selected><-- Pilih Desa --></option>
                                        </select>
                                        @error('desa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>                                

                                <div class="form-group row">
                                    <label for="jalan" class="col-sm-3 col-form-label">Jalan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Jalan" value="{{$student->jalan}}">
                                        @error('jalan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Kode POS</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="{{$student->kode_pos}}">
                                        @error('kode_pos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jarak_rumah" class="col-sm-3 col-form-label">Jarak Rumah (km)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jarak_rumah" name="jarak_rumah" placeholder="Jarak Rumah" value="{{$student->jarak_rumah}}">
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Edit Riwayat Sekolah --}}
        <div class="edit-profil-siswa">
            <form method="post" action="/student/{{$student->id}}/{{$lastyearstudent->id}}/editriwayatsekolah" enctype="multipart/form-data">
                <div class="modal fade" id="UbahRiwayatSekolahModalCenter" tabindex="-1" role="dialog" aria-labelledby="UbahRiwayatSekolahModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="UbahRiwayatSekolahModalCenterTitle">Ubah Profil Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                @method('patch')
    
                                <div class="form-group row">
                                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk Sekolah" value="{{$student->tahun_masuk}}">
                                        @error('tahun_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kelas" class="col-sm-3 col-form-label">Masuk Kelas-</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select kelas" name="kelas" value="{{ old('kelas') }}">
                                            <div class="body-kelas">
                                                <option value=""><-- Pilih Kelas--></option>
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}" @if ($level->id == $student->kelas)
                                                        selected
                                                    @endif>{{$level->kelas}}</option>
                                                @endforeach
                                            </div>                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya" value="{{$student->sekolah_sebelumnya}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kelas_sekarang" class="col-sm-3 col-form-label">Kelas Tahun Ajaran Ini</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select kelas_sekarang" name="kelas_sekarang" value="{{ old('kelas_sekarang') }}">
                                            <div class="body-kelas_sekarang">
                                                <option value="" selected><-- Pilih Kelas--></option>
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}" @if ($lastyearstudent->level_id == $level->id)
                                                        selected
                                                    @endif>{{$level->kelas}}</option>
                                                @endforeach
                                            </div>                                            
                                        </select>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

            
@endsection

@section('script')
<script type="text/javascript">

let adafoto = false;

$(document).ready(async function(){
    
    let desa = $('.desa').text();
    let kecamatan = $('.kecamatan').text();
    let kabupaten = $('.kabupaten').text();
    let provinsi = $('.provinsi').text();
    let namaProvinsi = '';

    let dataProvinsi = await funcprovinsi(await token());
    dataProvinsi.forEach(d=>{
        $('#provinsi').append(`<option value="${d.id}">${d.name}</option>`);
        if (d.id == provinsi) {
            namaProvinsi = d.name
        }
    });
    $('.provinsi').text(namaProvinsi);
    $('#provinsi').val(provinsi);

    let dataKabupaten = await funckabupaten(await token(),provinsi);   
    dataKabupaten.forEach(dk => {
        $("#kabupaten").append(`<option value="${dk.id}">${dk.name}</option>`);
        if (dk.id == kabupaten) {
            namaKabupaten = dk.name
        }
    }); 
    $('.kabupaten').text(namaKabupaten);
    $('#kabupaten').val(kabupaten);

    let datakecamatan = await funckecamatan(await token(), kabupaten);
    datakecamatan.forEach(dk => {
        $("#kecamatan").append(`<option value="${dk.id}">${dk.name}</option>`);
        if (dk.id == kecamatan) {
            namaKecamatan = dk.name
        }
    });  
    $('.kecamatan').text(namaKecamatan);
    $('#kecamatan').val(kecamatan);

    let datadesa =  await funcdesa(await token(), kecamatan)
    datadesa.forEach(dk => {
        $("#desa").append(`<option value="${dk.id}">${dk.name}</option>`);
        if (dk.id == desa) {
            namaDesa = dk.name
        }
    });
    $('.desa').text(namaDesa);
    $('#desa').val(desa);

    $("#provinsi").change(async function(){
        let idprovinsi = $("#provinsi").val();            
        $("#kabupaten").empty();        
        $("#kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
        $("#kecamatan").empty();        
        $("#kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
        $("#desa").empty();        
        $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

        let dataKabupaten = await funckabupaten(await token(),idprovinsi);   
        dataKabupaten.forEach(dk => {
            $("#kabupaten").append(`<option value="${dk.id}">${dk.name}</option>`);
        });        
    });

    $('#kabupaten').change(async function(){
        let idkabupaten = $("#kabupaten").val();
        $("#kecamatan").empty();        
        $("#kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
        $("#desa").empty();        
        $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
        
        let datakecamatan = await funckecamatan(await token(), idkabupaten);
        datakecamatan.forEach(dk => {
            $("#kecamatan").append(`<option value="${dk.id}">${dk.name}</option>`);
        });  
    });

    $('#kecamatan').change(async function(){
        $('#ubah').show();
        let idkecamatan = $("#kecamatan").val();
        $("#desa").empty();        
        $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
        
        let datadesa =  await funcdesa(await token(), idkecamatan)
        datadesa.forEach(dk => {
            $("#desa").append(`<option value="${dk.id}">${dk.name}</option>`);
        });    
    });

    

    $('.edit-foto').click(function(){
        let textEditFoto = $('.edit-foto').text();    
        let foto='';
        let id = $(this).data('id');
        
        $('.ubah').show();
        if (textEditFoto=='Ubah Foto'){
            foto = `<input type="file" class="form-control-file" id="image" name="image">`;            
            $('.edit-foto').text("Batal Ubah Foto")   
        }else if(textEditFoto=='Batal Ubah Foto'){
            if (id) {
                foto = `<div class="foto"><img src="{{asset('img/student/${id}')}}" alt="foto-student" class="img-thumbnail">`;
            } else {
                foto = `<div class="foto"><img src="{{asset('img/user.png')}}" alt="foto-student" class="img-thumbnail">`;
            }
            
            $('.edit-foto').text("Ubah Foto");
        };    
        $('.body-image').html(foto);  
    });
})
    

</script>
    
@endsection