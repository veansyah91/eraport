@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
    
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            @if (Auth::user()->staff_id)
                                {{ Auth::user()->staff->nama }} <span class="caret"></span>
                            @elseif (Auth::user()->student_id)
                                @if (Auth::user()->student->image)
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('img/student/'.Auth::user()->student->image)}}" alt="User profile picture">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('img/user.png')}}" alt="User profile picture">
                                    </div>
                                @endif

                                <h3 class="profile-username text-center">{{ Auth::user()->student->nama }}</h3>
            
                                <table class="table table-responsive table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Nomor Induk</td>
                                            <td>: {{Auth::user()->student->no_induk}}</td>
                                        </tr>   
                                        <tr>
                                            <td>NISN</td>
                                            <td>: {{Auth::user()->student->nisn}}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>: {{Auth::user()->student->nik}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
    
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h2 class="card-title">BIODATA</h2>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->staff_id)
                                {{ Auth::user()->staff->nama }} <span class="caret"></span>
                            @elseif (Auth::user()->student_id)
                                <table class="table table-responsive table-borderless">
                                    <tbody>
                                        <tr>
                                            <td style="width:10em">Nama</td>
                                            <td>: {{Auth::user()->student->nama}}</td>
                                        </tr>   
                                        <tr>
                                            <td>Tempat Lahir dan Tanggal Lahir</td>
                                            <td>: {{Auth::user()->student->tempat_lahir}}, {{Auth::user()->student->tgl_lahir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: {{Auth::user()->student->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tinggi Badan</td>
                                            <td>: {{Auth::user()->student->tinggi_badan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Berat Badan</td>
                                            <td>: {{Auth::user()->student->berat_badan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Anak Ke-</td>
                                            <td>: {{Auth::user()->student->anak_ke}}</td>
                                        </tr>
                                        <tr>
                                            <td>Hobi</td>
                                            <td>: {{Auth::user()->student->hobi}}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>: {{Auth::user()->student->agama}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div><!-- /.card-body -->
                    </div>
                <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-3">
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h2 class="card-title">BIODATA ORANG TUA</h2>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->staff_id)
                                {{ Auth::user()->staff->nama }} <span class="caret"></span>
                            @elseif (Auth::user()->student_id)
                                <table class="table table-responsive table-borderless">
                                    <tbody>
                                        <tr>
                                            <td style="width:10em">Nama Ayah</td>
                                            <td>: {{Auth::user()->student->nama_ayah}}</td>
                                        </tr>   
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>: {{Auth::user()->student->nama_ibu}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Ayah</td>
                                            <td>: {{Auth::user()->student->pekerjaan_ayah}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Ibu</td>
                                            <td>: {{Auth::user()->student->pekerjaan_ibu}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Ayah</td>
                                            <td>: {{Auth::user()->student->pendidikan_ayah}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Ibu</td>
                                            <td>: {{Auth::user()->student->pendidikan_ibu}}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>: {{Auth::user()->student->agama}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div><!-- /.card-body -->
                    </div>
                <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-3">
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h2 class="card-title">ALAMAT</h2>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->staff_id)
                                {{ Auth::user()->staff->nama }} <span class="caret"></span>
                            @elseif (Auth::user()->student_id)
                                <table class="table table-responsive table-borderless">
                                    <tbody>
                                        <tr>
                                            <td style="width:10em">Jalan</td>
                                            <td>: {{Auth::user()->student->jalan}}</td>
                                        </tr>   
                                        <tr>
                                            <td>Desa</td>
                                            <td >: <span class="desa">{{Auth::user()->student->desa}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td >: <span class="kecamatan">{{Auth::user()->student->kecamatan}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten</td>
                                            <td >: <span class="kabupaten">{{Auth::user()->student->kabupaten}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td >: <span class="provinsi">{{Auth::user()->student->provinsi}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pos</td>
                                            <td>: {{Auth::user()->student->kode_pos}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jarak</td>
                                            <td>: {{Auth::user()->student->jarak}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div><!-- /.card-body -->
                    </div>
                <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->
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

    console.log(provinsi);
    let dataProvinsi = await funcprovinsi(await token());
    dataProvinsi.forEach(d=>{
        if (d.id == provinsi) {
            namaProvinsi = d.name;
        }
    });
    
    $('.provinsi').text(namaProvinsi);

    let dataKabupaten = await funckabupaten(await token(),provinsi);   
    dataKabupaten.forEach(dk => {
        if (dk.id == kabupaten) {
            namaKabupaten = dk.name
        }
    }); 
    $('.kabupaten').text(namaKabupaten);

    let datakecamatan = await funckecamatan(await token(), kabupaten);
    datakecamatan.forEach(dk => {
        if (dk.id == kecamatan) {
            namaKecamatan = dk.name
        }
    });  
    $('.kecamatan').text(namaKecamatan);

    let datadesa =  await funcdesa(await token(), kecamatan)
    datadesa.forEach(dk => {
        if (dk.id == desa) {
            namaDesa = dk.name
        }
    });
    $('.desa').text(namaDesa);
    
})
    

</script>
    
@endsection