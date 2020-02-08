@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                        @if ($students->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
                            <a href="/add-student" class="btn btn-primary btn-sm">Tambah Data Siswa</a>
                        @else
                        <table class="table table-hover" id="student-table">
                            <thead>
                            <tr>
                                <th scope="col">Nomor Induk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tempat/Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $s)
                                    <tr>
                                        <td>{{$s->no_induk}}</td>
                                        <td>{{$s->nama}}</td>
                                        <td>{{$s->tempat_lahir}}/{{$s->tgl_lahir}}</td>
                                        <td>{{$s->jenis_kelamin}}</td>
                                        <td>{{$s->agama}}</td>
                                        <td>{{$s->tahun_masuk}}</td>
                                        <td> 
                                            <button type="button" class="btn btn-primary btn-sm detail-student" data-toggle="modal" 
                                            data-target="#siswaModalCenter"
                                            data-id="{{$s->id}}"
                                            data-nik="{{$s->nik}}"
                                            data-no_induk="{{$s->no_induk}}"
                                            data-nisn="{{$s->nisn}}"
                                            data-nama="{{$s->nama}}"
                                            data-tempatlahir="{{$s->tempat_lahir}}"
                                            data-tgllahir="{{$s->tgl_lahir}}"
                                            data-jeniskelamin="{{$s->jenis_kelamin}}"
                                            data-agama="{{$s->agama}}"
                                            data-tinggi_badan="{{$s->tinggi_badan}}"
                                            data-berat_badan="{{$s->berat_badan}}"
                                            data-hobi="{{$s->hobi}}"
                                            data-tahun_masuk="{{$s->tahun_masuk}}"
                                            data-sekolah_sebelumnya="{{$s->sekolah_sebelumnya}}"
                                            data-nama_ayah="{{$s->nama_ayah}}"
                                            data-nama_ibu="{{$s->nama_ibu}}"
                                            data-anak_ke="{{$s->anak_ke}}"
                                            data-pekerjaan_ayah="{{$s->pekerjaan_ayah}}"
                                            data-pekerjaan_ibu="{{$s->pekerjaan_ibu}}"
                                            data-pendidikan_ayah="{{$s->pendidikan_ayah}}"
                                            data-pendidikan_ibu="{{$s->pendidikan_ibu}}"
                                            data-jarak_rumah="{{$s->jarak_rumah}}"
                                            data-jalan="{{$s->jalan}}"
                                            data-desa="{{$s->desa}}"
                                            data-kecamatan="{{$s->kecamatan}}"
                                            data-kabupaten="{{$s->kabupaten}}"
                                            data-kecamatan="{{$s->kecamatan}}"
                                            data-provinsi="{{$s->provinsi}}"
                                            data-kode_pos="{{$s->kode_pos}}"
                                            data-kelas="{{$s->kelas}}"
                                            data-image="{{$s->image}}"
                                            ><i class="far fa-list-alt"></i></button>
                                            <button class="btn btn-danger btn-sm student-delete" delete-id="{{$s->id}}"><i class="far fa-trash-alt"></i></a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal fade" id="siswaModalCenter" tabindex="-1" role="dialog" aria-labelledby="siswaModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="siswaModalCenterTitle">Detail Siswa</h5>
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
                                        <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" placeholder="Tahun Masuk Sekolah">
                                            @error('tahun_masuk')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="kelas" class="col-sm-3 col-form-label">Masuk Kelas-</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="kelas" name="kelas">
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="sekolah_sebelumnya" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya"">
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
                                        <label class="col-sm-12 h5"><u>ALAMAT SISWA</u></label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select class="custom-select" data-id="{{tokenAPI()}}" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
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
                                            <select class="custom-select" data-id="{{tokenAPI()}}" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
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
                                            <select class="custom-select" data-id="{{tokenAPI()}}" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
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
                                            <select class="custom-select" data-id="{{tokenAPI()}}" id="desa" name="desa" value="{{ old('desa') }}">
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
                                            <button type="button" class="btn btn-primary btn-sm edit-foto" id="edit-foto">Ubah Foto</button>
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
            </div>
        </section>
        <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    $('document').ready(async function(){
        let token1 = await token();
    
        $('.detail-student').click(async function(){
            $('#staffModalCenter').modal();
            $('.ubah').hide();

            let id= $(this).data('id');
            $('form').attr(`action`,`/student/${id}/edit`)

            let nik= $(this).attr('data-nik');
            $('#nik').val(nik);
            $('#nik').keyup(function(){
                $('.ubah').show()
            })

            let nama= $(this).attr('data-nama');
            $('#nama').val(nama);
            $('#nama').keyup(function(){
                $('.ubah').show()
            })

            let tempat_lahir= $(this).attr('data-tempatlahir');
            $('#tempat_lahir').val(tempat_lahir);
            $('#tempat_lahir').keyup(function(){
                $('.ubah').show()
            })

            let tgllahir= $(this).attr('data-tgllahir');
            $('#tgl_lahir').val(tgllahir);        
            $('#tgl_lahir').keyup(function(){
                $('.ubah').show()
            })

            let jeniskelamin= $(this).attr('data-jeniskelamin');
            $('#jenis_kelamin').val(jeniskelamin);
            $('#jenis_kelamin').keyup(function(){
                $('.ubah').show()
            })

            let agama= $(this).attr('data-agama');
            $('#agama').val(agama);
            $('#agama').keyup(function(){
                $('.ubah').show()
            })

            let no_induk= $(this).data('no_induk');
            $('#no_induk').val(no_induk);
            $('#no_induk').keyup(function(){
                $('.ubah').show()
            })

            let nisn= $(this).data('nisn');
            $('#nisn').val(nisn);
            $('#nisn').keyup(function(){
                $('.ubah').show()
            })

            let tinggi_badan= $(this).data('tinggi_badan');
            $('#tinggi_badan').val(tinggi_badan);
            $('#tinggi_badan').keyup(function(){
                $('.ubah').show()
            })

            let berat_badan= $(this).data('berat_badan');
            $('#berat_badan').val(berat_badan);
            $('#berat_badan').keyup(function(){
                $('.ubah').show()
            })

            let hobi= $(this).data('hobi');
            $('#hobi').val(hobi);
            $('#hobi').keyup(function(){
                $('.ubah').show()
            })

            let tahun_masuk= $(this).data('tahun_masuk');
            $('#tahun_masuk').val(tahun_masuk);
            $('#tahun_masuk').keyup(function(){
                $('.ubah').show()
            })

            let sekolah_sebelumnya= $(this).data('sekolah_sebelumnya');
            $('#sekolah_sebelumnya').val(sekolah_sebelumnya);
            $('#sekolah_sebelumnya').keyup(function(){
                $('.ubah').show()
            })

            let nama_ayah= $(this).data('nama_ayah');
            $('#nama_ayah').val(nama_ayah);
            $('#nama_ayah').keyup(function(){
                $('.ubah').show()
            })

            let nama_ibu= $(this).data('nama_ibu');
            $('#nama_ibu').val(nama_ibu);
            $('#nama_ibu').keyup(function(){
                $('.ubah').show()
            })

            let anak_ke= $(this).data('anak_ke');
            $('#anak_ke').val(anak_ke);
            $('#anak_ke').keyup(function(){
                $('.ubah').show()
            })

            let pekerjaan_ayah= $(this).data('pekerjaan_ayah');
            $('#pekerjaan_ayah').val(pekerjaan_ayah);
            $('#pekerjaan_ayah').keyup(function(){
                $('.ubah').show()
            })

            let pekerjaan_ibu= $(this).data('pekerjaan_ibu');
            $('#pekerjaan_ibu').val(pekerjaan_ibu);
            $('#pekerjaan_ibu').keyup(function(){
                $('.ubah').show()
            })

            let pendidikan_ayah= $(this).data('pendidikan_ayah');
            $('#pendidikan_ayah').val(pendidikan_ayah);
            $('#pendidikan_ayah').keyup(function(){
                $('.ubah').show()
            })

            let pendidikan_ibu= $(this).data('pendidikan_ibu');
            $('#pendidikan_ibu').val(pendidikan_ibu);
            $('#pendidikan_ibu').keyup(function(){
                $('.ubah').show()
            })

            let jarak_rumah= $(this).data('jarak_rumah');
            $('#jarak_rumah').val(jarak_rumah);
            $('#jarak_rumah').keyup(function(){
                $('.ubah').show()
            })

            let jalan= $(this).data('jalan');
            $('#jalan').val(jalan);
            $('#jalan').keyup(function(){
                $('.ubah').show()
            })
            
            let provinsi= $(this).data('provinsi');
            let dataProvinsi = await funcprovinsi(token1);
            dataProvinsi.forEach(p=>{
                $('#provinsi').append(`<option value="${p.id}">${p.name}</option>`);
            })
            $('#provinsi').val(provinsi);
            
            
            let kabupaten= $(this).data('kabupaten');
            let dataKabupaten = await funckabupaten(token1,provinsi);
            dataKabupaten.forEach(kb=>{
                $('#kabupaten').append(`<option value="${kb.id}">${kb.name}</option>`);
            })
            $('#kabupaten').val(kabupaten);

            let kecamatan= $(this).data('kecamatan');
            let dataKecamatan = await funckecamatan(token1,kabupaten);
            dataKecamatan.forEach(kc=>{
                $('#kecamatan').append(`<option value="${kc.id}">${kc.name}</option>`);
            })
            $('#kecamatan').val(kecamatan);

            let desa= $(this).data('desa');
            let dataDesa = await funcdesa(token1,kecamatan);
            dataDesa.forEach(d=>{
                $('#desa').append(`<option value="${d.id}">${d.name}</option>`);
            })
            $('#desa').val(desa);

            let kode_pos= $(this).data('kode_pos');
            $('#kode_pos').val(kode_pos);
            $('#kode_pos').keyup(function(){
                $('.ubah').show()
            })

            let kelas= $(this).data('kelas');  
            $('#kelas').val(kelas);
            $('#kelas').keyup(function(){
                $('.ubah').show()
            })

            let image= $(this).data('image');  
            let bodyImage='';
            if (image){
                bodyImage = `<img src="{{asset('img/student/${image}')}}" alt="foto-student" class="img-thumbnail">`;
            } else{
                bodyImage = `<input type="file" class="form-control-file" id="image" name="image">
                            <p class="text-danger"><em>Foto belum dimasukkan</em></p>`
            };            
            $(".body-image").html(bodyImage);


            $("#provinsi").change(async function(){
                $('.ubah').show();
                let idprovinsi = $("#provinsi").val();        
                let id= $(this).data('id');  
                
                $("#kabupaten").empty();        
                $("#kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
                $("#kecamatan").empty();        
                $("#kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
                $("#desa").empty();        
                $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

                let dataKabupaten = await funckabupaten(id,idprovinsi);        
                dataKabupaten.forEach(dk => {
                    $("#kabupaten").append(`<option value="${dk.id}">${dk.name}</option>`);
                });
                
            });

            $('#kabupaten').change(async function(){
                $('.ubah').show();
                let idkabupaten = $("#kabupaten").val();
                let id= $(this).data('id');

                $("#kecamatan").empty();        
                $("#kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
                $("#desa").empty();        
                $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
                
                let datakecamatan = await funckecamatan(id, idkabupaten);
                datakecamatan.forEach(dk => {
                    $("#kecamatan").append(`<option value="${dk.id}">${dk.name}</option>`);
                });
                        
                
            });

            $('#kecamatan').change(async function(){
                $('.ubah').show();
                let idkecamatan = $("#kecamatan").val();
                let id= $(this).data('id');
                $("#desa").empty();        
                $("#desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
                
                let datadesa =  await funcdesa(id, idkecamatan)
                datadesa.forEach(dk => {
                    $("#desa").append(`<option value="${dk.id}">${dk.name}</option>`);
                });
                        
                
            });

            $('#edit-foto').click(function(){
                let textEditFoto = $('#edit-foto').text();    
                let foto='';
                $('.ubah').show();
                if (textEditFoto=='Ubah Foto'){
                    foto = `<input type="file" class="form-control-file" id="image" name="image">`;            
                    $('#edit-foto').text("Batal Ubah Foto")   
                }else if(textEditFoto=='Batal Ubah Foto'){
                    foto = `<div class="foto"><img src="{{asset('img/student/${image}')}}" alt="foto-student" class="img-thumbnail">`;
                    $('#edit-foto').text("Ubah Foto");
                };    
                $('.body-image').html(foto);  
            });

        })

        $('.student-delete').click(function(){
            let delete_id = $(this).attr('delete-id');
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
        })

        $('#student-table').DataTable(
            {responsive: true}
        );

    });

    
</script>
    
@endsection
