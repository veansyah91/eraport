@extends('layouts.main')

@section('content')    
    
    <div class="content-wrapper mt-5">
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Tambah Data Staff
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
                            <hr>
                                <form method="post" action="/add-staff" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>IDENTITAS GURU</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="nip" class="col-sm-3 col-form-label">NIP<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="{{ old('nip') }}">
                                        @error('nip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
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
                                    <label for="agama" class="col-sm-3 col-form-label">Agama<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama" value="{{ old('agama') }}">
                                        @error('agama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status_nikah" class="col-sm-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="status_nikah" name="status_nikah">
                                            <option value="" selected><-- Pilih Status Pernikahan --></option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                        </select>
                                        @error('status_nikah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_pasangan" class="col-sm-3 col-form-label">Nama Pasangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" placeholder="Nama Pasangan" value="{{ old('nama_pasangan') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan_pasangan" class="col-sm-3 col-form-label">Pekerjaan Pasangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan_pasangan" name="pekerjaan_pasangan" placeholder="Pekerjaan Pasangan" value="{{ old('pekerjaan_pasangan') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nip_pasangan" class="col-sm-3 col-form-label">NIP Pasangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nip_pasangan" name="nip_pasangan" placeholder="NIP Pasangan" value="{{ old('nip_pasangan') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
                                        @error('nama_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>PENDIDIKAN</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                            <option value="" selected><-- Pilih Pendidikan Terakhir --></option>
                                            <option value="SD">SD/Sederajat</option>
                                            <option value="SMP">SMP/Sederajat</option>
                                            <option value="SMA">SMA/Sederajat</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" placeholder="Tahun Masuk" value="{{ old('tahun_masuk') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus" value="{{ old('tahun_lulus') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ipk" class="col-sm-3 col-form-label">IPK</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ipk" name="ipk" placeholder="IPK" value="{{ old('ipk') }}">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-12 h5"><u>KEPEGAWAIAN</u></label>
                                </div>

                                <div class="form-group row">
                                    <label for="status_pegawai" class="col-sm-3 col-form-label">Status Kepegawaian</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="status_pegawai" name="status_pegawai">
                                            <option value="" selected><-- Pilih Status Kepegawaian --></option>
                                            <option value="PNS">PNS</option>
                                            <option value="PNS">CPNS</option>
                                            <option value="Guru Bantu Pusat">Guru Bantu Pusat</option>
                                            <option value="GIT/Honorer Daerah">GIT/Honorer Daerah</option>
                                            <option value="GIT/Honorer Sekolah">GIT/Honorer Sekolah</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tmt_pengangkatan" class="col-sm-3 col-form-label">TMT Pengangkatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tmt_pengangkatan" name="tmt_pengangkatan" placeholder="tmt_pengangkatan" value="{{ old('tmt_pengangkatan') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_sk" class="col-sm-3 col-form-label">Nomor SK Pengangkatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="No SK Pengangkatan" value="{{ old('no_sk') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_sk" class="col-sm-3 col-form-label">Tanggal SK Pengangkatan</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_sk" name="tgl_sk" value="{{ old('tgl_sk') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tmt_pns" class="col-sm-3 col-form-label">TMT PNS</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tmt_pns" name="tmt_pns" placeholder="TMT PNS" value="{{ old('tmt_pns') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_sk_pns" class="col-sm-3 col-form-label">Nomor SK PNS</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_sk_pns" name="no_sk_pns" placeholder="No SK PNS" value="{{ old('no_sk_pns') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_sk_berkala" class="col-sm-3 col-form-label">Tanggal SK Berkala</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_sk_berkala" name="tgl_sk_berkala" value="{{ old('tgl_sk_berkala') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tmt_sekolah" class="col-sm-3 col-form-label">TMT Sekolah Ini</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tmt_sekolah" name="tmt_sekolah" placeholder="TMT Sekolah Ini" value="{{ old('tmt_sekolah') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_sk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_sk_sekolah" name="tgl_sk_sekolah" value="{{ old('tgl_sk_sekolah') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_sertifikasi" class="col-sm-3 col-form-label">Nomor Sertifikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_sertifikasi" name="no_sertifikasi" placeholder="Nomor Sertifikasi" value="{{ old('no_sertifikasi') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_peserta_sertifikasi" class="col-sm-3 col-form-label">Nomor Peserta Sertifikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_peserta_sertifikasi" name="no_peserta_sertifikasi" placeholder="Nomor Peserta Sertifikasi" value="{{ old('no_peserta_sertifikasi') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nrg" class="col-sm-3 col-form-label">NRG</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nrg" name="nrg" placeholder="NRG" value="{{ old('nrg') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tgl_masuk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tgl_masuk_sekolah" name="tgl_masuk_sekolah" value="{{ old('tgl_masuk_sekolah') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Gambar</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" id="image" name="image">
                                    </div>
                                </div>
                                
                                <div class="form-group row float-right">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary ">Tambah</button>
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