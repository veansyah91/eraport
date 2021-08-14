<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SDIT Abu Bakar</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/guest.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap/guest.css') }}"> --}}
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}"> --}}

</head>
<body>

    <div class="container">

      <div class="row mt-2">
        <div class="col-8">
          <a href="{{ route('guest-index') }}" class="btn btn-success">
            Halaman Sebelumnya
          </a>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-8 text-center">
          <h2 class="font-weight-bold">
            Pendaftaran Siswa Baru
          </h2>
        </div>
      </div>

      <form action="" method="post">
        @csrf
        <div class="row justify-content-center mt-2">
          <div class="col-8">
            <div class="card">
              <div class="card-header text-center">
                <h5 class="font-weight-bold text-uppercase">
                  Identitas Siswa
                </h5>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                  <div class="col-sm-9">
                      <input required type="text" class="form-control" name="nik" placeholder="NIK" value="{{ old('nik') }}">
                      @error('nik')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input required type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select required class="custom-select" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                            <option value=""><-- Pilih Jenis Kelamin --></option>
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <option value="PEREMPUAN">PEREMPUAN</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tinggi_badan" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">
                        @error('tinggi_badan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="berat_badan" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="berat_badan" placeholder="Berat Badan" value="{{ old('berat_badan') }}">
                        @error('berat_badan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hobi" class="col-sm-3 col-form-label">Hobi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hobi" placeholder="Hobi" value="{{ old('hobi') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="agama" placeholder="Agama" value="ISLAM">
                        @error('agama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="anak_ke" class="col-sm-3 col-form-label">Anak ke-</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="anak_ke" value="1">
                        @error('anak_ke')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-2">
          <div class="col-8">
            <div class="card">
              <div class="card-header text-center">
                <h5 class="font-weight-bold text-uppercase">
                  Identitas Orang Tua
                </h5>
              </div>

              <div class="card-body">

                <div class="form-group row">
                  <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                  <div class="col-sm-9">
                    <input required type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}">
                    @error('nama_ayah')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}">
                        @error('pekerjaan_ayah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}">
                        @error('pekerjaan_ibu')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="pendidikan_ayah" placeholder="Pendidikan Ayah" value="{{ old('pendidikan_ayah') }}">
                        @error('pendidikan_ayah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" name="pendidikan_ibu" placeholder="Pendidikan Ibu" value="{{ old('pendidikan_ibu') }}">
                        @error('pendidikan_ibu')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                  <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP Orang Tua</label>
                  <div class="col-sm-9">
                      <input required type="text" class="form-control" name="no_hp" placeholder="Nomor HP Orange Tua" value="{{ old('no_hp') }}">
                      @error('no_hp')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-2">
          <div class="col-8">
            <div class="card">
              <div class="card-header text-center">
                <h5 class="font-weight-bold text-uppercase">
                  Alamat
                </h5>
              </div>

              <div class="card-body">

                <div class="form-group row">
                  <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                  <div class="col-sm-9">
                      <select required class="custom-select provinsi" name="provinsi" value="{{ old('provinsi') }}">
                          <option><-- Pilih Provinsi --></option>
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
                        <select required class="custom-select kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
                            <option ><-- Pilih Kabupaten --></option>
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
                        <select class="custom-select kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                            <option><-- Pilih Kecamatan --></option>
                        </select>
                        @error('kecamatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="desa" class="col-sm-3 col-form-label">Desa</label>
                    <div class="col-sm-9">
                        <select class="custom-select desa" name="desa" value="{{ old('desa') }}" required>
                            <option><-- Pilih Desa --></option>
                        </select>
                        @error('desa')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                  <label for="jalan" class="col-sm-3 col-form-label">Jalan</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" name="jalan" placeholder="Jalan" value="{{ old('jalan') }}">
                      @error('jalan')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label for="image" class="col-sm-3 col-form-label">Kode POS</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" value="{{ old('kode_pos') }}">
                      @error('kode_pos')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label for="jarak_rumah" class="col-sm-3 col-form-label">Jarak Rumah</label>
                  <div class="col-sm-9">
                      <input required type="text" class="form-control" name="jarak_rumah" placeholder="Jarak Rumah" value="{{ old('jarak_rumah') }}">
                  </div>
              </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-2">
          <div class="col-8">
            <div class="card">
              <div class="card-header text-center">
                <h5 class="font-weight-bold text-uppercase">
                  Riwayat Sekolah <small class="text-lowercase">(jika ada)</small>
                </h5>
              </div>

              <div class="card-body">

                <div class="form-group row">
                  <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk Sekolah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk Sekolah" value="{{Date('Y')}}">
                      @error('tahun_masuk')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="kelas" class="col-sm-3 col-form-label">Masuk Kelas-</label>
                    <div class="col-sm-9">
                        <select class="custom-select kelas" id="kelas" name="kelas" value="{{ old('kelas') }}">
                            <div class="body-kelas">
                                @foreach ($levels as $level)
                                    <option value="{{$level->id}}" @if($level->id == 1) selected @endif >{{$level->kelas}}</option>
                                @endforeach
                            </div>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sekolah_sebelumnya" class="col-sm-3 col-form-label">Sekolah Sebelumnya</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="sekolah_sebelumnya" placeholder="Sekolah Sebelumnya" value="{{ old('sekolah_sebelumnya') }}">
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-2 mb-3">
          <div class="col-8 text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

      </form>


    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>

    <script src="{{asset('js/wilayah.js')}} "></script>

    <script type="text/javascript">

      $(document).ready(async function ()
      {
          const kelas = document.getElementById('kelas');
          const kelasSekarang = document.getElementById('kelas-sekarang');

          kelas.addEventListener('change', function(){
              kelasSekarang.value = this.value;
          })

          const isLoading = `<div class="spinner-border" role="status">
                              <span class="sr-only">Memuat Data...</span>
                            </div>`

          $('.provinsi').append(`<option disabled>${isLoading}</option>`)

          let dataProvinsi = await funcprovinsi(await token());

          if (dataProvinsi) {
            $('.provinsi').empty()
            $('.provinsi').append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
          }
          dataProvinsi.forEach(d=>{
              $('.provinsi').append(`<option value="${d.id}">${d.name}</option>`);
          });

          $(".provinsi").change(async function(){
              let idprovinsi = $(".provinsi").val();
              $(".kabupaten").empty();
              $(".kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
              $(".kabupaten").append(`<option disabled>${isLoading}</option>`);
              $(".kecamatan").empty();
              $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
              $(".desa").empty();
              $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

              let responseDataKabupaten = await funckabupaten(await token(),idprovinsi);
              let dataKabupaten = responseDataKabupaten.data;

              if (responseDataKabupaten.code == 200) {
                $(".kabupaten").empty();
                $(".kabupaten").append(`<option value="" selected><-- Pilih Kabupaten --></option>`);
                dataKabupaten.forEach(dk => {
                  $(".kabupaten").append(`<option value="${dk.id}">${dk.name}</option>`);
                });
              } else {
                console.log('Data Kabupaten Tidak Ditemukan');
              }

          });

          $('.kabupaten').change(async function(){
              let idkabupaten = $(".kabupaten").val();
              $(".kecamatan").empty();
              $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
              $(".kecamatan").append(`<option disabled>${isLoading}</option>`);
              $(".desa").empty();
              $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

              let responseDatakecamatan = await funckecamatan(await token(), idkabupaten);
              let datakecamatan = responseDatakecamatan.data;

              if (responseDatakecamatan.code == 200) {
                $(".kecamatan").empty();
                $(".kecamatan").append(`<option value="" selected><-- Pilih Kecamatan --></option>`);
                datakecamatan.forEach(dk => {
                  $(".kecamatan").append(`<option value="${dk.id}">${dk.name}</option>`);
              });
              } else {
                console.log('Data Kecamatan Tidak Ditemukan');
              }
          });

          $('.kecamatan').change(async function(){
              let idkecamatan = $(".kecamatan").val();
              $(".desa").empty();
              $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);
              $(".desa").append(`<option disabled>${isLoading}</option>`);

              let responseDataDesa = await funcdesa(await token(), idkecamatan)
              let dataDesa =  responseDataDesa.data

              if (responseDataDesa.code == 200) {
                $(".desa").empty();
                $(".desa").append(`<option value="" selected><-- Pilih Desa --></option>`);

                dataDesa.forEach(dk => {
                  $(".desa").append(`<option value="${dk.id}">${dk.name}</option>`);
                });

              } else {
                console.log('Data Desa Tidak Ditemukan');
              }


          });
      })
    </script>

</body>
</html>
