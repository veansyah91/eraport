@extends('layouts.main')

@section('content')    
    
        
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Ubah Data Siswa
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
                        <form method="post" action="" enctype="multipart/form-data">   
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-sm-12 h5"><u>IDENTITAS SISWA</u></label>
                            </div>

                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="{{$student->nik}}">
                                    @error('nik')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_induk" class="col-sm-3 col-form-label">Nomor Induk<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_induk" name="no_induk" placeholder="Nomor Induk" value="{{$student->no_induk}} ">
                                    @error('no_induk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN" value="{{$student->nisn}}" >
                                    @error('nisn')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{$student->nama}}">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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
                                        <option value="LAKI-LAKI" @if ($student->jenis_kelamin == "LAKI-LAKI") selected @endif>LAKI-LAKI</option>
                                        <option value="PEREMPUAN" @if ($student->jenis_kelamin == "PEREMPUAN") selected @endif>PEREMPUAN</option>
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
                                    <input type="text" class="form-control" id="hobi" name="hobi" placeholder="Hobi" value=" {{$student->hobi}} ">
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
                                <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu<span class="text-danger" value="{{$student->jpekerjaan_ibu}}">*</span></label>
                                <div class="col-sm-9" >
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

                            <div class="form-group row">
                                <label class="col-sm-12 h5"><u>RIWAYAT SEKOLAH</u></label>
                            </div>

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
                                <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya" value="{{$student->sekolah_sebelumnya}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-12 h5"><u>ALAMAT SISWA</u></label>
                            </div>
                            
                            <div class="form-group row">
                                <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select class="custom-select provinsi" id="provinsi" name="provinsi">
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
                                <label for="jarak_rumah" class="col-sm-3 col-form-label">Jarak Rumah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jarak_rumah" name="jarak_rumah" placeholder="Jarak Rumah" value="{{$student->jarak_rumah}}">
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="image" class="col-sm-3 col-form-label">Foto Siswa</label>
                                <div class="col-sm-5 ">
                                    <div class="body-image">
                                        @if ($student->image)
                                            <img src="{{asset('img/student/'.$student->image)}}" alt="foto-student" class="img-thumbnail">
                                        @else
                                            <input type="file" class="form-control-file" id="image" name="image">
                                            <p class="text-danger"><em>Foto belum dimasukkan</em></p>
                                        @endif
                                    </div>
                                    <br>
                                    @if ($student->image)
                                        <button type="button" class="btn btn-primary btn-sm edit-foto" data-foto="{{ $student->image}}">Ubah Foto</button>
                                    @endif
                                    
                                </div>
                            </div> 

                            <div class="form-group row float-right">
                                <button type="submit" class="btn btn-primary ubah ">Ubah</button>
                            </div>                            
                                            
                        </form>
                                        
                    </div>
                </div>
            </div>
        </section>
        
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(async function ()
    {
        let idProvinsi = {{$student->provinsi}};
        let idKabupaten = {{$student->kabupaten}};
        let idKecamatan = {{$student->kecamatan}};
        let idDesa = {{$student->desa}};

        let dataProvinsi = await funcprovinsi(await token());
        dataProvinsi.forEach(d=>{
            $('.provinsi').append(`<option value="${d.id}">${d.name}</option>`);
        });
        
        $('#provinsi').val(idProvinsi);

        let dataKabupaten = await funckabupaten(await token(),idProvinsi);
        dataKabupaten.forEach(kb=>{
            $('.kabupaten').append(`<option value="${kb.id}">${kb.name}</option>`);
        });
        $('.kabupaten').val(idKabupaten);

        let dataKecamatan = await funckecamatan(await token(),idKabupaten);
        dataKecamatan.forEach(kc=>{
            $('.kecamatan').append(`<option value="${kc.id}">${kc.name}</option>`);
        })
        $('.kecamatan').val(idKecamatan);

        let dataDesa = await funcdesa(await token(),idKecamatan);
        dataDesa.forEach(d=>{
            $('.desa').append(`<option value="${d.id}">${d.name}</option>`);
        });
        $('.desa').val(idDesa);

        $(".provinsi").change(async function(){
            let idProvinsi = $(".provinsi").val();            
            $(".kabupaten").empty();        
            $(".kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
            $(".kecamatan").empty();        
            $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
            $(".desa").empty();        
            $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

            let dataKabupaten = await funckabupaten(await token(),idProvinsi);
            
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


        $('.edit-foto').click(function()
        {
            console.log('ubah');            
            let foto = $(this).data('foto');   

            let textEditFoto = $('.edit-foto').text();    
            let htmlfoto='';

            $('.ubah').show();
            if (textEditFoto=='Ubah Foto'){
                htmlfoto = `<input type="file" class="form-control-file" id="image" name="image">`;            
                $('.edit-foto').text("Batal Ubah Foto")   
            }else if(textEditFoto=='Batal Ubah Foto'){
                htmlfoto = `<div class="foto"><img src="{{asset('img/student/${foto}')}}" alt="foto-student" class="img-thumbnail">`;
                $('.edit-foto').text("Ubah Foto");
            };    
            $('.body-image').html(htmlfoto);  
        });

    }
)

</script>
    
@endsection