@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Data Siswa
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
                                <th scope="col">Tempat/Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Foto</th>

                            </tr>
                            </thead>
                            <tbody>
                    
                            </tbody>
                        </table>

                    </div>
                </div>     
            </div>

            {{-- Modal Input --}}
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal fade" id="tambahSiswaModalCenter" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="tambahSiswaModalCenterTitle">Tambah Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>IDENTITAS SISWA</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nik" placeholder="NIK">
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="no_induk" placeholder="Nomor Induk" >
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nisn" placeholder="NISN" >
                                        @error('nisn')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" >
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" >
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tgl_lahir" >
                                        @error('tgl_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" name="jenis_kelamin" >
                                            <option value="" selected><-- Pilih Jenis Kelamin --></option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tinggi_badan" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan">
                                        @error('tinggi_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="berat_badan" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="berat_badan" placeholder="Berat Badan">
                                        @error('berat_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hobi" class="col-sm-3 col-form-label">Hobi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="hobi" placeholder="Hobi" >
                                    </div>
                                </div>

                                

                                <div class="form-group row">
                                    <label for="agama" class="col-sm-3 col-form-label">Agama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="agama" placeholder="Agama" >
                                        @error('agama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="anak_ke" class="col-sm-3 col-form-label">Anak ke-<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="anak_ke" value="1">
                                        @error('anak_ke')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah">
                                        @error('nama_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu">
                                        @error('nama_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                                        @error('pekerjaan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                                        @error('pekerjaan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pendidikan_ayah" placeholder="Pendidikan Ayah">
                                        @error('pendidikan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pendidikan_ibu" placeholder="Pendidikan Ibu">
                                        @error('pendidikan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>RIWAYAT SEKOLAH</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk Sekolah" value="{{Date('Y')}}">
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
                                                <option value="" selected><-- Pilih Kelas--></option>
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}">{{$level->kelas}}</option>
                                                @endforeach
                                            </div>                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya"">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kelas_sekarang" class="col-sm-3 col-form-label">Kelas Tahun Ajaran Ini</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select kelas_sekarang" name="kelas_sekarang" value="{{ old('kelas_sekarang') }}">
                                            <div class="body-kelas_sekarang">
                                                <option value="" selected><-- Pilih Kelas--></option>
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}">{{$level->kelas}}</option>
                                                @endforeach
                                            </div>                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>ALAMAT SISWA</u></label>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select provinsi" name="provinsi" value="{{ old('provinsi') }}">
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
                                        <select class="custom-select kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
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
                                        <select class="custom-select kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
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
                                        <select class="custom-select desa" name="desa" value="{{ old('desa') }}">
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
                                        <input type="text" class="form-control" name="jalan" placeholder="Jalan" >
                                        @error('jalan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Kode POS</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos">
                                        @error('kode_pos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jarak_rumah" class="col-sm-3 col-form-label">Jarak Rumah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jarak_rumah" placeholder="Jarak Rumah">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Foto Siswa</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" id="image" name="image">
                                    </div>
                                </div>                                

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Tambah</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            {{-- Modal Edit --}}
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal fade" id="editSiswaModalCenter" tabindex="-1" role="dialog" aria-labelledby="editSiswaModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editSiswaModalCenterTitle">Detail Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">                                
                                @method('patch')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>IDENTITAS SISWA</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_induk" name="no_induk" placeholder="Nomor Induk" >
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN" >
                                        @error('nisn')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" >
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" >
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" >
                                        @error('tgl_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" >
                                            <option value="" selected><-- Pilih Jenis Kelamin --></option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tinggi_badan" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan">
                                        @error('tinggi_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="berat_badan" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="berat_badan" name="berat_badan" placeholder="Berat Badan">
                                        @error('berat_badan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hobi" class="col-sm-3 col-form-label">Hobi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="hobi" name="hobi" placeholder="Hobi" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agama" class="col-sm-3 col-form-label">Agama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama" >
                                        @error('agama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="anak_ke" class="col-sm-3 col-form-label">Anak ke-<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="anak_ke" name="anak_ke">
                                        @error('anak_ke')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                                        @error('nama_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                                        @error('nama_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                                        @error('pekerjaan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                                        @error('pekerjaan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" placeholder="Pendidikan Ayah">
                                        @error('pendidikan_ayah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" placeholder="Pendidikan Ibu">
                                        @error('pendidikan_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>RIWAYAT SEKOLAH</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk Sekolah" value="{{Date('Y')}}">
                                        @error('tahun_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya"">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>ALAMAT SISWA</u></label>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select provinsi" id="edit-provinsi" name="provinsi">
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
                                        <select class="custom-select kabupaten" id="kabupaten" name="kabupaten" >
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
                                        <select class="custom-select kecamatan" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
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
                                        <select class="custom-select desa" id="desa" name="desa" value="{{ old('desa') }}">
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
                                        <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Jalan" >
                                        @error('jalan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Kode POS</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos">
                                        @error('kode_pos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jarak_rumah" class="col-sm-3 col-form-label">Jarak Rumah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jarak_rumah" name="jarak_rumah" placeholder="Jarak Rumah">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Foto Siswa</label>
                                    <div class="col-sm-5 ">
                                        <div class="body-image">
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-primary btn-sm edit-foto" >Ubah Foto</button>
                                    </div>
                                </div>                            

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <div class="ubah-modal">
                                    <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(async function ()
{
    let dataProvinsi = await funcprovinsi(await token());
    dataProvinsi.forEach(d=>{
        $('.provinsi').append(`<option value="${d.id}">${d.name}</option>`);
    });
    $(".provinsi").change(async function(){
        let idprovinsi = $(".provinsi").val();            
        $(".kabupaten").empty();        
        $(".kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
        $(".kecamatan").empty();        
        $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
        $(".desa").empty();        
        $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

        let dataKabupaten = await funckabupaten(await token(),idprovinsi);
        
        dataKabupaten.forEach(dk => {
            $(".kabupaten").append(`<option value="${dk.id}">${dk.name}</option>`);
        });        
    });

    $('.kabupaten').change(async function(){
        let idkabupaten = $(".kabupaten").val();
        $(".kecamatan").empty();        
        $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
        $(".desa").empty();        
        $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
        
        let datakecamatan = await funckecamatan(await token(), idkabupaten);
        datakecamatan.forEach(dk => {
            $(".kecamatan").append(`<option value="${dk.id}">${dk.name}</option>`);
        });  
    });

    $('.kecamatan').change(async function(){
        $('.ubah').show();
        let idkecamatan = $(".kecamatan").val();
        $(".desa").empty();        
        $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
        
        let datadesa =  await funcdesa(await token(), idkecamatan)
        datadesa.forEach(dk => {
            $(".desa").append(`<option value="${dk.id}">${dk.name}</option>`);
        });    
    });
    
    var table = $('#student-table').DataTable({
            processing:true,
            serverside:true,
            ajax:"{{route('ajax.get.data.students')}}",
            columns:[
                    {data:'no_induk',name:'no_induk'},
                    {data:'nama',name:'nama'},
                    {data:'ttl',name:'ttl'},
                    {data:'jenis_kelamin',name:'jenis_kelamin'},
                    {data:'agama',name:'agama'},
                    {data:'tahun_masuk',name:'tahun_masuk'},
                    {
                    name: 'image',
                    data: 'image',
                    render: function (data, type, full, meta) {
                        return data? '<img src="img/student/' + data + '" height=\"50\"/>' : '<img src="img/user.png" height=\"50\"/>';
                    },
                    title: 'Foto',
                    orderable: true,
                    searchable: true
                },
                    ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Detail '+data.nama;
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
            dom: 'Bfrtip',
            buttons:[
                        {
                            text: 'Tambah',
                            action: function ( e, dt, node, config ) {
                                $('form').attr(`action`,`/add-student`);
                                $('#tambahSiswaModalCenter').modal();
                            },
                        },
                        {
                            extend: 'selected',
                            text: 'Ubah Data',
                            className : 'btn-success',
                            action: async function ( e, dt, button, config ) {
                                        let jmlBaris = dt.rows( { selected: true } ).indexes().length;
                                        let value = table.rows({ selected: true } );
                                        if (jmlBaris > 1) {
                                            swal({
                                                icon: 'error',
                                                title: 'Silakan Pilih 1 Data Saja',
                                            })                                   
                                        }     
                                        else
                                        {
                                            let idsiswa = value.data()[0].id;
                                            window.location = `/student/${idsiswa}/edit`;
                                        }            
                                    }
                        
                        },
                        {
                            extend: 'selected',
                            text: 'Hapus Data',
                            className : 'btn-danger',
                            action: function ( e, dt, button, config ) {                                    
                                        let jmlBaris = dt.rows( { selected: true } ).indexes().length;
                                        let value = table.rows({ selected: true } );
                                        if (jmlBaris > 1) {
                                            swal({
                                                icon: 'error',
                                                title: 'Silakan Pilih 1 Data Saja',
                                            })                                   
                                        }else   
                                            {
                                                let delete_id = value.data()[0].id;  
                                            
                                                swal({
                                                    title: "Apakah Anda Yakin Menghapus Data Ini?",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,

                                                })
                                                .then((willDelete) => {
                                                    if (willDelete) {
                                                        window.location = `/student/${delete_id}/delete`;
                                                    
                                                    }
                                                })
                                            }
                                                                        
                                    }
                        
                        },
                        
                        {
                            extend: 'selected',
                            text: 'Detail Data',
                            className : 'btn-info',
                            action: function ( e, dt, button, config ) {                                    
                                        let jmlBaris = dt.rows( { selected: true } ).indexes().length;
                                        let value = table.rows({ selected: true } );
                                        if (jmlBaris > 1) {
                                            swal({
                                                icon: 'error',
                                                title: 'Silakan Pilih 1 Data Saja',
                                            })                                   
                                        }else   
                                            {
                                                let data_id = value.data()[0].id;  
                                                
                                                window.location = `/student/${data_id}`;
                                            }
                                                                        
                                    }
                        
                        },
                    ],
            select: true,
    });

    $('.kelas').change(function(){
        let kelas = $('.kelas').val();
        $('.kelas_sekarang').val(kelas);
    });

    $('.kelas_sekarang').val($('.kelas').val());
})
</script>
    
@endsection