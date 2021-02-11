@extends('layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Jadwal Pendaftaran Tahun ({{ Date('Y') }})
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
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>
                                    Gelombang 1
                                </h3>
                                <form class="form-inline" method="POST" action='/registry-schedule'>
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <input type="hidden" name="kategori" value="Gelombang 1">
                                        <div class="col">
                                            <label for="dari" class="col-form-label">Dari</label>
                                        </div>
                                        <div class="col">
                                          <input type="date" id="dari" class="form-control" name="mulai" value="{{ $gelombang1 ? $gelombang1->mulai : ''}}">
                                        </div>
                                        <div class="col">
                                            <label for="dari" class="col-form-label">Sampai</label>
                                        </div>
                                        <div class="col">
                                          <input id="dari" type="date" class="form-control" name="akhir" value="{{ $gelombang1 ? $gelombang1->akhir : ''}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Atur</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <h3>
                                    Gelombang 2
                                </h3>
                                <form class="form-inline" method="POST" action='/registry-schedule'>
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <input type="hidden" name="kategori" value="Gelombang 2">
                                        <div class="col">
                                            <label for="dari" class="col-form-label">Dari</label>
                                        </div>
                                        <div class="col">
                                          <input type="date" id="dari" class="form-control" name="mulai" value="{{ $gelombang2 ? $gelombang2->mulai : '' }}">
                                        </div>
                                        <div class="col">
                                            <label for="dari" class="col-form-label">Sampai</label>
                                        </div>
                                        <div class="col">
                                          <input id="dari" type="date" class="form-control" name="akhir" value="{{ $gelombang2 ? $gelombang2->akhir : '' }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Atur</button>
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>  
            </div>
        </section>             
        
@endsection

@section('script')
<script type="text/javascript">

})


</script>
@endsection
