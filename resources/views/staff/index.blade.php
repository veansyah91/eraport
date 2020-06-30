@extends('layouts.main')

@section('content')
            <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Data Staff
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
                        <table class="table table-hover display responsive nowrap staff-table" id="staff-table" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tempat/Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Pendidikan Terakhir</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Status Menikah</th>
                                <th scope="col">Nama Pasangan</th>
                                <th scope="col">Pekerjaan Pasangan</th>
                                <th scope="col">Foto</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                            </tbody>
                        </table>

                    </div>
                </div>            

                {{-- Modal Input Staff --}}
                <form method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="modal fade" id="tambahStaffModalCenter" tabindex="-1" role="dialog" aria-labelledby="tambahStaffModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="tambahStaffModalCenterTitle">Tambah Staff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-12 h5"><u>IDENTITAS GURU</u></label>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{ old('nik') }}">
                                                @error('nik')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nip" placeholder="NIP" value="{{ old('nip') }}">
                                                @error('nip')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                                                @error('nama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                                @error('tempat_lahir')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                                @error('tgl_lahir')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="custom-select" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
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
                                                <input type="text" class="form-control" name="agama" placeholder="Agama" value="{{ old('agama') }}">
                                                @error('agama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                                                @error('alamat')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="status_nikah" class="col-sm-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="custom-select" name="status_nikah">
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
                                                <input type="text" class="form-control" name="nama_pasangan" placeholder="Nama Pasangan" value="{{ old('nama_pasangan') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="pekerjaan_pasangan" class="col-sm-3 col-form-label">Pekerjaan Pasangan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  name="pekerjaan_pasangan" placeholder="Pekerjaan Pasangan" value="{{ old('pekerjaan_pasangan') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="nip_pasangan" class="col-sm-3 col-form-label">NIP Pasangan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nip_pasangan" placeholder="NIP Pasangan" value="{{ old('nip_pasangan') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
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
                                                <select class="custom-select" name="pendidikan_terakhir">
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
                                                <input type="text" class="form-control" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nim" placeholder="NIM" value="{{ old('nim') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk" value="{{ old('tahun_masuk') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tahun_lulus" placeholder="Tahun Lulus" value="{{ old('tahun_lulus') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="ipk" class="col-sm-3 col-form-label">IPK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="ipk" placeholder="IPK" value="{{ old('ipk') }}">
                                            </div>
                                        </div>
    
                                        <hr>
    
                                        <div class="form-group row">
                                            <label class="col-sm-12 h5"><u>KEPEGAWAIAN</u></label>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="status_pegawai" class="col-sm-3 col-form-label">Status Kepegawaian</label>
                                            <div class="col-sm-9">
                                                <select class="custom-select" name="status_pegawai">
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
                                                <input type="text" class="form-control" name="tmt_pengangkatan" placeholder="tmt_pengangkatan" value="{{ old('tmt_pengangkatan') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="no_sk" class="col-sm-3 col-form-label">Nomor SK Pengangkatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_sk" placeholder="No SK Pengangkatan" value="{{ old('no_sk') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tgl_sk" class="col-sm-3 col-form-label">Tanggal SK Pengangkatan</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_sk" value="{{ old('tgl_sk') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tmt_pns" class="col-sm-3 col-form-label">TMT PNS</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tmt_pns" placeholder="TMT PNS" value="{{ old('tmt_pns') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="no_sk_pns" class="col-sm-3 col-form-label">Nomor SK PNS</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_sk_pns" placeholder="No SK PNS" value="{{ old('no_sk_pns') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tgl_sk_berkala" class="col-sm-3 col-form-label">Tanggal SK Berkala</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_sk_berkala" value="{{ old('tgl_sk_berkala') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tmt_sekolah" class="col-sm-3 col-form-label">TMT Sekolah Ini</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tmt_sekolah" placeholder="TMT Sekolah Ini" value="{{ old('tmt_sekolah') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tgl_sk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_sk_sekolah" value="{{ old('tgl_sk_sekolah') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="no_sertifikasi" class="col-sm-3 col-form-label">Nomor Sertifikasi</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_sertifikasi" placeholder="Nomor Sertifikasi" value="{{ old('no_sertifikasi') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="no_peserta_sertifikasi" class="col-sm-3 col-form-label">Nomor Peserta Sertifikasi</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_peserta_sertifikasi" placeholder="Nomor Peserta Sertifikasi" value="{{ old('no_peserta_sertifikasi') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="nrg" class="col-sm-3 col-form-label">NRG</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nrg" placeholder="NRG" value="{{ old('nrg') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="tgl_masuk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_masuk_sekolah" value="{{ old('tgl_masuk_sekolah') }}">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-3 col-form-label">Gambar</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file" name="image">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <div class="ubah-modal">
                                            <button type="submit" class="btn btn-primary ubah">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>


                {{-- Modal Edit Staff --}}
                <form method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                    <div class="modal fade" id="editStaffModalCenter" tabindex="-1" role="dialog" aria-labelledby="editStaffModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editStaffModalCenterTitle">Edit Staff</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-12 h5"><u>IDENTITAS GURU</u></label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nik" class="col-sm-3 col-form-label">NIK<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{ old('nik') }}">
                                            @error('nik')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                        <div class="col-sm-5">
                                            <div class="body-image">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary btn-sm edit-foto" id="edit-foto">Ubah Foto</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <div class="ubah-modal">
                                        <button type="submit" class="btn btn-primary tombol">Ubah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                
            </div>
        </section>
        <!-- /.content -->
        </div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready( function (){

    var table = $('#staff-table').DataTable({
        processing:true,
        serverside:true,
        ajax:"{{route('ajax.get.data.staff')}}",
        columns:[
                {data:'nip',name:'nip'},
                {data:'nik',name:'nik'},
                {data:'nama',name:'nama'},
                {data:'ttl',name:'ttl'},
                {data:'jenis_kelamin',name:'jenis_kelamin'},
                {data:'agama',name:'agama'},
                {data:'alamat',name:'alamat'},
                {data:'pendidikan_terakhir',name:'pendidikan_terakhir'},
                {data:'jurusan',name:'jurusan'},
                {data:'nama_ibu',name:'nama_ibu'},
                {data:'status_nikah',name:'status_nikah'},
                {data:'nama_pasangan',name:'nama_pasangan'},
                {data:'pekerjaan_pasangan',name:'pekerjaan_pasangan'},
                {
                    name: 'image',
                    data: 'image',
                    render: function (data, type, full, meta) {
                        return data? '<img src="img/staff/' + data + '" height=\"50\"/>' : '<img src="img/user.png" height=\"50\"/>';
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
                            $('form').attr(`action`,`/add-staff`);
                            $('#tambahStaffModalCenter').modal();
                        },
                    },
                    {
                        extend: 'selected',
                        text: 'Ubah Data',
                        className : 'btn-success',
                        action: function ( e, dt, button, config ) {
                                    let jmlBaris = dt.rows( { selected: true } ).indexes().length;
                                    let value = table.rows({ selected: true } );
                                    if (jmlBaris > 1) {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Silakan Pilih 1 Data Saja Untuk Diedit',
                                        })                                    
                                    }     
                                    else{
                                        $('form').attr(`action`,`/staff/${value.data()[0].id}/edit`);
                                        $('#editStaffModalCenter').modal();
                                        
                                    
                                        $('#nip').val(value.data()[0].nip);
                                        $('#nik').val(value.data()[0].nik);
                                        $('#nama').val(value.data()[0].nama);
                                        $('#tempat_lahir').val(value.data()[0].tempat_lahir);
                                        $('#tgl_lahir').val(value.data()[0].tgl_lahir);
                                        $('#jenis_kelamin').val(value.data()[0].jenis_kelamin);
                                        $('#agama').val(value.data()[0].agama);
                                        $('#alamat').val(value.data()[0].alamat);
                                        $('#status_nikah').val(value.data()[0].status_nikah);
                                        $('#nama_pasangan').val(value.data()[0].nama_pasangan);
                                        $('#pekerjaan_pasangan').val(value.data()[0].pekerjaan_pasangan);
                                        $('#nip_pasangan').val(value.data()[0].nip_pasangan);
                                        $('#nama_ibu').val(value.data()[0].nama_ibu);
                                        $('#pendidikan_terakhir').val(value.data()[0].pendidikan_terakhir);
                                        $('#jurusan').val(value.data()[0].jurusan);
                                        $('#nim').val(value.data()[0].nim);
                                        $('#tahun_masuk').val(value.data()[0].tahun_masuk);
                                        $('#tahun_lulus').val(value.data()[0].tahun_lulus);
                                        $('#ipk').val(value.data()[0].ipk);
                                        $('#status_pegawai').val(value.data()[0].status_pegawai);
                                        $('#tmt_pengangkatan').val(value.data()[0].tmt_pengangkatan);
                                        $('#no_sk').val(value.data()[0].no_sk);
                                        $('#tgl_sk').val(value.data()[0].tgl_sk);
                                        $('#tmt_pns').val(value.data()[0].tmt_pns);
                                        $('#no_sk_pns').val(value.data()[0].no_sk_pns);
                                        $('#tgl_sk_berkala').val(value.data()[0].tgl_sk_berkala);
                                        $('#no_sertifikasi').val(value.data()[0].no_sertifikasi);
                                        $('#no_peserta_sertifikasi').val(value.data()[0].no_peserta_sertifikasi);
                                        $('#nrg').val(value.data()[0].nrg);
                                        $('#tgl_masuk_sekolah').val(value.data()[0].tgl_masuk_sekolah);
                                        $('#nip').val(value.data()[0].nip);
                                        let foto = '';
                                        if (value.data()[0].image) {
                                            foto = `<img src="{{asset('img/staff/${value.data()[0].image}')}}" alt="foto-student" class="img-thumbnail">`;
                                        } else {
                                            foto = `<input type="file" class="form-control-file"   id="image" name="image">
                                                <p class="text-danger"><em>Foto belum dimasukkan</em></p>`
                                        }
                                        $(".body-image").html(foto);
                                        $('#edit-foto').click(function(){
                                            let textEditFoto = $('#edit-foto').text();    
                                            let foto='';
                                            $('.ubah').show();
                                            if (textEditFoto=='Ubah Foto'){
                                                foto = `<input type="file" class="form-control-file" id="image" name="image">`;            
                                                $('#edit-foto').text("Batal Ubah Foto")   
                                            }else if(textEditFoto=='Batal Ubah Foto'){
                                                foto = `<div class="foto"><img src="{{asset('img/staff/${value.data()[0].image}')}}" alt="foto-student" class="img-thumbnail">`;
                                                $('#edit-foto').text("Ubah Foto");
                                            };    
                                            $('.body-image').html(foto);  
                                        });
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
                                            text: 'Silakan Pilih 1 Data Saja Untuk Duhapus',
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
                                                window.location = `/staff/${delete_id}/delete`;
                                                }
                                            })
                                        }                                                                    
                                }                    
                    },
                ],
        select: true,
    });



    

} );
</script>
    
@endsection
