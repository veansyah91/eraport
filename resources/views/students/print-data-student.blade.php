<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .page-break {
                page-break-after: always;
            }
            .logo{
                margin-top: 150px;
            }

            .text-center{
                text-align: center;
            }

            .text-right{
                text-align: right;
            }

            .border-solid{
                border: solid 0.5px black;
                border-collapse: collapse;
            }

            .center {
                margin: auto;
                width: 60%;
                padding: 10px;
            }

            .nama{
                margin-top: 50px;
            }

            .keterangan{
                margin-top: 50px;
            }

            .data-sekolah{
                margin-top: 100px;
                margin-left: 50px;
            }

            .data-sekolah td{
                width: 150px; height:50px;
            }

            .detail-alamat{
                margin-top: 50px;
                margin-left: 50px;
            }
            .detail-alamat td{
                width: 150px; height:50px;
            }

            .petunjuk-penggunaan, .biodata-siswa{
                margin-top: 15px;
                margin-left: 50px;
                margin-right: 50px;
            }

            .petunjuk-penggunaan li{
                margin-bottom: 10px;
                text-align: justify;
            }

            .biodata-siswa td{
                width: 170px; height:35px;
            }

            .footer{
                margin-top: 25px;
            }

            .gambar{
                border: 0.5px solid black;
                width: 3cm;
                height: 4cm;
                float: right;
            }

        </style>

    </head>
    <body>
    
        <div class="header">
            <div class="text-center">
                <h3>Data Siswa Kelas {{ $subleveldetail->level->kelas }} {{ $subleveldetail->alias }}</h3>
            </div>
        </div>

        <div class="content">
            <table class="border-solid">
                <thead style="width:100%">
                    <tr>
                        <th class="border-solid">NIK</th>
                        <th class="border-solid">Nama</th>
                        <th class="border-solid">Tempat / Tanggal Lahir</th>
                        <th class="border-solid">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sublevelstudents as $sublevelstudent)
                        <tr>
                            <td class="border-solid">{{ $sublevelstudent->nik }}</td>
                            <td class="border-solid">{{ $sublevelstudent->nama }}</td>
                            <td class="border-solid">{{ $sublevelstudent->tempat_lahir }}/{{ $sublevelstudent->tgl_lahir }}</td>
                            <td class="border-solid">{{ $sublevelstudent->jalan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
    </body>
</html>