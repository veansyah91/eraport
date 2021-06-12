@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelas {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    <h4>Status Kenaikan Kelas</h4>
                </div>
                <div class="col-sm-6">
                    <h5 class="text-right">Semester {{ Year::thisSemester()->semester }}</h5>
                    <h5 class="text-right">Tahun Ajaran {{ Year::thisSemester()->year->awal }}/{{ Year::thisSemester()->year->akhir }}</h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8" id="main-content">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5><strong>Ketidakhadiran</strong></h5>
                                </div>
                            </div>
                            
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="extra-table">
                                            <thead class="table-info text-center">
                                                <tr>
                                                    <th style="width: 2em">#</th>
                                                    <th >Nama Siswa</th>
                                                    <th >Status Kenaikan Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sublevelstudents as $student)
                                                    <tr class="student-row" data-student-id = "{{ $student->student_id }}" data-student-nama = "{{ $student->nama }}">
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>
                                                        <td>
                                                            {{$student->nama}}
                                                        </td>

                                                        <td class="text-center">
                                                            <span class="status-naik">
                                                                
                                                            </span>
                                                            
                                                            <a 
                                                                class="btn btn-sm btn-link tombol-input-status"  
                                                                
                                                                href="#input-status"

                                                                onclick="editStatus({{$loop->index}})"
                                                            >
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $sublevelstudents->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4" id="input-status">
                    <div class="card">
                        <div class="card-header">
                            <h5><strong>Input/Edit Status Kenaikan Kelas</strong></h5>
                        </div>

                        <div class="card-body" id="form-input">
                            <div class="row">
                                <div class="col">
                                    <input type="text" hidden id="indexInput">
                                    <input type="text" hidden id="input-student-id">
                                    <div class="form-group">
                                        <label for="studentInput">Nama</label>
                                        <input type="text" class="form-control" id="nama-siswa" name="Nama Siswa" placeholder="Nama Siswa" disabled>                     
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Keterangan</label>
                                        <select class="form-control" id="inputStatusModal" name="inputStatusModal">
                                            <option value="0">Tinggal Kelas</option>
                                            <option value="1">Naik Kelas</option>
                                        </select>   
                                    </div>
        
                                    <a href="#main-content" class="btn btn-secondary" id="cancel-button">Batal</a>
                                    <button type="submit" class="btn btn-primary" id="submit-modal">Simpan</button>
                                </div>
                            </div>
                            
                            <div class="row mt-3" id="alert-success" style="display: none">
                                <div class="col">
                                    <div class="alert alert-success">
                                        Berhasil Ubah Data
                                        <button type="button" class="close" id="close-alert">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                        
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
    
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

<script>

    const getUpLevel = (student) => {
        return fetch(`/api/uplevel/${student}`)
                .then(response => response.json())
                .then(response => response.data);
    }

    const inputStatus = (input) => {  
        let result = {};
        (async () => {
            let response = await fetch('/api/uplevel',
                                {
                                    method: 'PUT',
                                    headers: {
                                        'Content-type' : 'application/json'
                                    },
                                    body: JSON.stringify(input)
                                });

            result = await response.json();
            console.log(`Berhasil: `, result);
        })()

    }

    window.addEventListener('load', async function(){
        const studentrows = Array.from(document.getElementsByClassName('student-row'));
        const statusNaik = Array.from(document.getElementsByClassName('status-naik'));
        const tombolInputStatus = Array.from(document.getElementsByClassName('tombol-input-status'));

        const namaSiswaInput = document.getElementById('nama-siswa');
        const modalInput = document.getElementById('inputStatusKenaikanKelas');
        
        const submitModal = document.getElementById('submit-modal');
        const tombolCancel = document.getElementById('cancel-button');

        const alertSuccess = document.getElementById('alert-success');
        const closeAlert = document.getElementById('close-alert');  

        submitModal.disabled = true;
        
        studentrows.forEach(async (studentrow, index) => {

            let studentId = studentrow.getAttribute('data-student-id');
            let studentNama = studentrow.getAttribute('data-student-nama');
            let status = await getUpLevel(studentId);
            
            statusNaik[index].innerHTML = status ? (status.status > 0 ? `<i>Naik Kelas</i>` : `<i>Tinggal Kelas</i>`) : `<i>Status Belum Diinput</i>`;

        });

        tombolCancel.addEventListener('click', () => {
            namaSiswaInput.value = '';
            submitModal.disabled = true;
        });

        closeAlert.addEventListener('click', () => {
            alertSuccess.style.display = 'none';
        });

        submitModal.addEventListener('click', async (e) => {
            const inputStudentId = document.getElementById('input-student-id');
            const inputStatusModal = document.getElementById('inputStatusModal');      
            const indexInput = document.getElementById('indexInput');
            // const statusNaik = document.getElementsByClassName('status-naik');

            let data = {
                    'student_id' : inputStudentId.value,
                    'status' : inputStatusModal.value
                }
                
            // input status kenaikan kelas ke database
            fetch('/api/uplevel', {
                    method: 'PUT', 
                    headers: {
                                'Content-Type': 'application/json',
                            },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Berhasil Update Data');
                    inputStatusModal.value = data.status;
                    alertSuccess.style.display = 'block';
                })
                .catch((error) => {
                console.error('Error:', error);
            });

            statusNaik[indexInput.value].innerHTML = inputStatusModal.value > 0 ? `<i>Naik Kelas</i>` : `<i>Tinggal Kelas</i>`;

            namaSiswaInput.value = '';
            submitModal.disabled = true;
        })

    })

    function editStatus(index){

        const studentrows = Array.from(document.getElementsByClassName('student-row'));
        
        const inputStudentId = document.getElementById('input-student-id');
        const submitModal = document.getElementById('submit-modal');
        const indexInput = document.getElementById('indexInput');
        const namaSiswaInput = document.getElementById('nama-siswa');

        let studentId = studentrows[index].getAttribute('data-student-id');
        let studentNama = studentrows[index].getAttribute('data-student-nama');

        inputStudentId.value = studentrows[index].getAttribute('data-student-id');
        namaSiswaInput.value = studentNama;
        submitModal.disabled = false;
        indexInput.value = index;

    };

    
    
</script>
    
@endsection