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
                        @if ($staff->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
                            <a href="/add-staff" class="btn btn-primary btn-sm">Tambah Data Staff</a>
                        @else
                        <table class="table table-hover display responsive nowrap" id="staff-table">
                            <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tempat/Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Pendidikan Terakhir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($staff as $s)
                                <tr>  
                                    <td> {{$s->nip}} </td>
                                    <td> {{$s->nama}} </td>
                                    <td> {{$s->tempat_lahir}} / {{$s->tgl_lahir}} </td>
                                    <td> {{$s->jenis_kelamin}} </td>
                                    <td> {{$s->agama}} </td>
                                    <td> {{$s->pendidikan_terakhir}} </td>
                                    <td> 
                                        <button type="button" class="btn btn-primary btn-sm detail-staff" data-toggle="modal" 
                                        data-target="#staffModalCenter"
                                        data-id="{{$s->id}}"
                                        data-nip="{{$s->nip}}"
                                        data-nama="{{$s->nama}}"
                                        data-tempatlahir="{{$s->tempat_lahir}}"
                                        data-tgllahir="{{$s->tgl_lahir}}"
                                        data-jeniskelamin="{{$s->jenis_kelamin}}"
                                        data-agama="{{$s->agama}}"
                                        data-alamat="{{$s->alamat}}"
                                        data-statusmenikah="{{$s->status_nikah}}"
                                        data-namapasangan="{{$s->nama_pasangan}}"
                                        data-pekerjaanpasangan="{{$s->pekerjaan_pasangan}}"
                                        data-nippasangan="{{$s->nip_pasangan}}"
                                        data-namaibu="{{$s->nama_ibu}}"
                                        data-pddterakhir="{{$s->pendidikan_terakhir}}"
                                        data-jurusan="{{$s->jurusan}}"
                                        data-nim="{{$s->nim}}"
                                        data-tahunmasuk="{{$s->tahun_masuk}}"
                                        data-tahunlulus="{{$s->tahun_lulus}}"
                                        data-ipk="{{$s->ipk}}"
                                        data-statuspegawai="{{$s->status_pegawai}}"
                                        data-tmtpengangkatan="{{$s->tmt_pengangkatan}}"
                                        data-nosk="{{$s->no_sk}}"
                                        data-tglsk="{{$s->tgl_sk}}"
                                        data-tmtpns="{{$s->tmt_pns}}"
                                        data-noskpns="{{$s->no_sk_pns}}"
                                        data-tglskberkala="{{$s->tgl_sk_berkala}}"
                                        data-tmtsekolah="{{$s->tmt_sekolah}}"
                                        data-tglsksekolah="{{$s->tgl_sk_sekolah}}"
                                        data-nosertifikasi="{{$s->no_sertifikasi}}"
                                        data-nopesertasertifikasi="{{$s->no_peserta_sertifikasi}}"
                                        data-nrg="{{$s->nrg}}"
                                        data-tglmasuksekolah="{{$s->tgl_masuk_sekolah}}"
                                        data-image="{{$s->image}}"
                                        ><i class="far fa-list-alt"></i></button>
                                        <button class="btn btn-danger btn-sm staff-delete" delete-id="{{$s->id}}"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>                              
                                @endforeach --}}
                    
                            </tbody>
                        </table>
                        @endif

                    </div>
                </div>            



                <div class="modal fade" id="staffModalCenter" tabindex="-1" role="dialog" aria-labelledby="staffModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staffModalCenterTitle">Detail Staff</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
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
$(document).ready( function (){
    $('.detail-staff').click(function(){
        $('#staffModalCenter').modal();

        let id= $(this).data('id');
        let nip= $(this).attr('data-nip');
        let nama= $(this).attr('data-nama');
        let tempatlahir= $(this).attr('data-tempatlahir');
        let tgllahir= $(this).attr('data-tgllahir');
        let jeniskelamin= $(this).attr('data-jeniskelamin');
        let agama= $(this).attr('data-agama');
        let pddterakhir= $(this).attr('data-id');
        let alamat= $(this).attr('data-alamat');
        let statusmenikah= $(this).attr('data-statusmenikah');
        let namapasangan= $(this).attr('data-namapasangan');
        let pekerjaanpasangan= $(this).attr('data-pekerjaanpasangan');
        let nippasangan= $(this).attr('data-nippasangan');
        let namaibu = $(this).data('namaibu');
        let jurusan= $(this).attr('data-jurusan');
        let nim= $(this).attr('data-nim');
        let tahunmasuk= $(this).attr('data-tahunmasuk');
        let tahunlulus= $(this).attr('data-tahunlulus');
        let ipk= $(this).attr('data-ipk');
        let statuspegawai= $(this).attr('data-statuspegawai');
        let tmtpengangkatan= $(this).attr('data-tmtpengangkatan');
        let nosk= $(this).attr('data-nosk');
        let tglsk= $(this).attr('data-tglsk');
        let tmtpns= $(this).attr('data-tmtpns');
        let noskpns= $(this).attr('data-noskpns');
        let tglskberkala= $(this).attr('data-tglskberkala');
        let tmtsekolah= $(this).attr('data-tmtsekolah');
        let tglsksekolah= $(this).attr('data-tglsksekolah');
        let nosertifikasi= $(this).data('nosertifikasi');
        let nopesertasertifikasi= $(this).attr('data-nopesertasertifikasi');
        let nrg= $(this).attr('data-nrg');
        let tglmasuksekolah= $(this).data('tglmasuksekolah');
        let image= $(this).data('image');  
        if (!image) image = 'user.png';   
                
        const detailStaff = `<div class="form-group row">
                                <label class="col-sm-12 h5"><u>IDENTITAS GURU</u></label>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</span></label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nip}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nama}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tempatlahir}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tgllahir}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${jeniskelamin}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${agama}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${alamat}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_nikah" class="col-sm-3 col-form-label">Status Pernikahan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${statusmenikah}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_pasangan" class="col-sm-3 col-form-label">Nama Pasangan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${namapasangan}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pekerjaan_pasangan" class="col-sm-3 col-form-label">Pekerjaan Pasangan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${pekerjaanpasangan}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip_pasangan" class="col-sm-3 col-form-label">NIP Pasangan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nippasangan}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${namaibu}<p>
                                </div>
                            </div>

                            <hr>
                            
                            <div class="form-group row">
                                <label class="col-sm-12 h5"><u>PENDIDIKAN</u></label>
                            </div>

                            <div class="form-group row">
                                <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${pddterakhir}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${jurusan}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nim}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tahunmasuk}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tahunlulus}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ipk" class="col-sm-3 col-form-label">IPK</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${ipk}<p>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-12 h5"><u>KEPEGAWAIAN</u></label>
                            </div>

                            <div class="form-group row">
                                <label for="status_pegawai" class="col-sm-3 col-form-label">Status Kepegawaian</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${statuspegawai}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tmt_pengangkatan" class="col-sm-3 col-form-label">TMT Pengangkatan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tmtpengangkatan}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_sk" class="col-sm-3 col-form-label">Nomor SK Pengangkatan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nosk}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_sk" class="col-sm-3 col-form-label">Tanggal SK Pengangkatan</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tglsk}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tmt_pns" class="col-sm-3 col-form-label">TMT PNS</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tmtpns}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_sk_pns" class="col-sm-3 col-form-label">Nomor SK PNS</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${noskpns}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_sk_berkala" class="col-sm-3 col-form-label">Tanggal SK Berkala</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tglskberkala}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tmt_sekolah" class="col-sm-3 col-form-label">TMT Sekolah Ini</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tmtsekolah}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_sk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tglsksekolah}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_sertifikasi" class="col-sm-3 col-form-label">Nomor Sertifikasi</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nosertifikasi}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_peserta_sertifikasi" class="col-sm-3 col-form-label">Nomor Peserta Sertifikasi</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nopesertasertifikasi}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nrg" class="col-sm-3 col-form-label">NRG</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${nrg}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_masuk_sekolah" class="col-sm-3 col-form-label">Tanggal SK Sekolah</label>
                                <div class="col-sm-9">
                                    <p type="text" class="form-control" >${tglmasuksekolah}<p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-5">
                                    <img src="{{asset('img/staff/${image}')}}" alt="foto-staff" class="img-thumbnail">
                                </div>
                            </div>`;
        
        $('.modal-body').html(detailStaff);

        const editStaff=`<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="/staff/${id}" type="button" class="btn btn-primary">Edit</a>`;

        $('.modal-footer').html(editStaff);
    })

    $('#staff-table').DataTable({
        processing:true,
        serverside:true,
        ajax:"{{route('ajax.get.data.staff')}}",
        columns:[
                {data:'nip',name:'nip'},
                {data:'nama',name:'nama'},
                {data:'ttl',name:'ttl'},
                {data:'jenis_kelamin',name:'jenis_kelamin'},
                {data:'agama',name:'agama'},
                {data:'pendidikan_terakhir',name:'pendidikan_terakhir'},
                {data:'aksi',name:'aksi'},
        ]
    });

    $('.staff-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
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
    })

    

} );
</script>
    
@endsection
