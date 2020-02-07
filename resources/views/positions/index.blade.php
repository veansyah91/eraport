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
                    Data Struktur Jabatan
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
                        @if ($positions->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
<<<<<<< Updated upstream
                            <button class="btn btn-primary btn-sm">Tambah Struktur Jabatan</button>
                        @else
                            <button class="btn btn-primary btn-sm">Tambah Struktur Jabatan</button>
                        
=======
                            <a href="/add-staff" class="btn btn-primary btn-sm">Tambah Struktur Jabatan</a>
                        @else
>>>>>>> Stashed changes
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
<<<<<<< Updated upstream
                                @foreach ($positions as $position)
                                <tr>  
                                    <td> {{$iteraion->loop}} </td>
                                    <td> {{$staff->nama}} </td>
=======
                                @foreach ($positions as $)
                                <tr>  
                                    <td> {{$staff->nip}} </td>
                                    <td> {{$staff->nama}} </td>
                                    <td> {{$staff->tempat_lahir}} / {{$staff->tgl_lahir}} </td>
                                    <td> {{$staff->jenis_kelamin}} </td>
                                    <td> {{$staff->agama}} </td>
                                    <td> {{$staff->pendidikan_terakhir}} </td>
                                    <td> 
                                        <button type="button" class="btn btn-primary btn-sm detail-staff" data-toggle="modal" 
                                        data-target="#staffModalCenter"
                                        data-id="{{$staff->id}}"
                                        data-nip="{{$staff->nip}}"
                                        data-nama="{{$staff->nama}}"
                                        data-tempatlahir="{{$staff->tempat_lahir}}"
                                        data-tgllahir="{{$staff->tgl_lahir}}"
                                        data-jeniskelamin="{{$staff->jenis_kelamin}}"
                                        data-agama="{{$staff->agama}}"
                                        data-alamat="{{$staff->alamat}}"
                                        data-statusmenikah="{{$staff->status_nikah}}"
                                        data-namapasangan="{{$staff->nama_pasangan}}"
                                        data-pekerjaanpasangan="{{$staff->pekerjaan_pasangan}}"
                                        data-nippasangan="{{$staff->nip_pasangan}}"
                                        data-namaibu="{{$staff->nama_ibu}}"
                                        data-pddterakhir="{{$staff->pendidikan_terakhir}}"
                                        data-jurusan="{{$staff->jurusan}}"
                                        data-nim="{{$staff->nim}}"
                                        data-tahunmasuk="{{$staff->tahun_masuk}}"
                                        data-tahunlulus="{{$staff->tahun_lulus}}"
                                        data-ipk="{{$staff->ipk}}"
                                        data-statuspegawai="{{$staff->status_pegawai}}"
                                        data-tmtpengangkatan="{{$staff->tmt_pengangkatan}}"
                                        data-nosk="{{$staff->no_sk}}"
                                        data-tglsk="{{$staff->tgl_sk}}"
                                        data-tmtpns="{{$staff->tmt_pns}}"
                                        data-noskpns="{{$staff->no_sk_pns}}"
                                        data-tglskberkala="{{$staff->tgl_sk_berkala}}"
                                        data-tmtsekolah="{{$staff->tmt_sekolah}}"
                                        data-tglsksekolah="{{$staff->tgl_sk_sekolah}}"
                                        data-nosertifikasi="{{$staff->no_sertifikasi}}"
                                        data-nopesertasertifikasi="{{$staff->no_peserta_sertifikasi}}"
                                        data-nrg="{{$staff->nrg}}"
                                        data-tglmasuksekolah="{{$staff->tgl_masuk_sekolah}}"
                                        data-image="{{$staff->image}}"
                                        ><i class="far fa-list-alt"></i></button>
                                        {{-- <form action="/staff/{{$staff->id}}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                        </form> --}}
>>>>>>> Stashed changes
                                        <button class="btn btn-danger btn-sm staff-delete" delete-id="{{$staff->id}}"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>                              
                                @endforeach
                    
                            </tbody>
                        </table>
                        @endif

                    </div>
                </div>            

            </div>
        </section>
        <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    
</script>
    
@endsection
