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
                        <div class="table-responsive">
                            <table class="table table-borderless student-table" id="student-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Nomor Induk</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                        
                                </tbody>
                            </table>
                        </div>
                        

                    </div>
                </div>
                
            </div>
        </section>
        <!-- /.content -->
        </div>
@endsection

@section('script')
<script type="text/javascript">

window.addEventListener('DOMContentLoaded', (event) => {    
    let table = $('#student-table').DataTable({
        processing:true,
        serverside:true,
        ajax:"{{route('ajax.get.user.data.student')}}",
        columns:[
                {data:'nisn',name:'nisn'},
                {data:'no_induk',name:'no_induk'},
                {data:'nama',name:'nama'},
                {data:'email',name:'email'},
                {data:'password',name:'password'},
                {data:'aksi',name:'aksi'},
        ],
    });
    
});

</script>
    
@endsection
