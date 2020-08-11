@extends('layouts.main')

@section('content')
            <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Ubah Email {{ $user->student->nama }}
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
                        <form method="POST" action="{{ url('/update-student-email/'.$user->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ __('Ubah') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                
            </div>
        </section>
        <!-- /.content -->
        </div>
@endsection

@section('script')
<script type="text/javascript">
</script>
    
@endsection
