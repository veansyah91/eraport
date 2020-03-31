@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Kelas
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
                        <div class="_container">
                            <div class="row">
                            <div class="col-12">
                                <p class="h6 font-italic">Data Kelas Belum Diatur</p>
                            </div>
                            </div>
                            <div class="form-group row mt-3">
                                <a href="/classes-create" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Atur Kelas Secara Otomatis
                                </a>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
@endsection
