<table class="table table-bordered" id="rekap-nilai-table">
    <thead>
        <tr>
            <th rowspan="3" scope="col" style="width: 2em">#</th>
            <th rowspan="3" scope="col">Nama</th>
            <th rowspan="2" scope="col" colspan="2">Spiritual KI-1</th>
            <th rowspan="2" scope="col" colspan="2">Sosial KI-2</th>
            
            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                    <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                @endif
            @endforeach 
            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                    <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                @endif
            @endforeach   
            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Muatan Lokal")
                    <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                @endif
            @endforeach  
            <th rowspan="3" scope="col">Jumlah Nilai</th>
            <th rowspan="3" scope="col">Rata-Rata</th>
            <th rowspan="3" scope="col">Ranking</th>
            
        </tr>
        <tr>
            @foreach ($levelsubjects as $levelsubject)
                <th scope="col" colspan="2">Pengetahuan</th>
                <th scope="col" colspan="2">Keterampilan</th>
            @endforeach
        </tr>
        <tr>
            <th scope="col">A</th>
            <th scope="col">H</th>
            <th scope="col">A</th>
            <th scope="col">H</th>
            @foreach ($levelsubjects as $levelsubject)
                <th scope="col">A</th>
                <th scope="col">H</th>
                <th scope="col">A</th>
                <th scope="col">H</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($studentperiods as $student)
            
            <tr>
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td>{{$student->nama}}</td>
                <td scope="col" class="text-center">
                    @php
                        $nilaispiritual = avSpiritualScore($student->student_id,$spiritualperiods);
                    @endphp
                    {{$nilaispiritual}}
                </td>
                <td scope="col" class="text-center">
                    @if (is_object(konversiNilai($nilaispiritual,"predikat")))
                        {{konversiNilai($nilaispiritual,"predikat")->nilai_huruf}}  
                    @else
                        {{konversiNilai($nilaispiritual,"predikat")}}                                                                                         
                    @endif
                </td>
                <td scope="col" class="text-center">
                    @php
                        $nilaiSosial = avSocialScore($student->student_id,$socialperiods);
                    @endphp
                    {{round($nilaiSosial)}}
                </td>
                <td scope="col" class="text-center">
                    @if (is_object(konversiNilai($nilaiSosial,"predikat")))
                        {{konversiNilai($nilaiSosial,"predikat")->nilai_huruf}}  
                    @else
                        {{konversiNilai($nilaiSosial,"predikat")}}                                                                                         
                    @endif
                </td>
                
                @php
                    $jumlahNilaiAngkaPerSiswa = 0;
                    $jumlahNilaiKeterampilanPerSiswa = 0;
                    $jumlahData = 0;
                @endphp
                @foreach ($levelsubjects as $levelsubject)
                    @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                    <td scope="col" class="text-center">
                        @php
                            $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                            $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{round($nilaiAngka)}}
                    </td>
                    <td scope="col" class="text-center">
                            {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                    </td>

                    <td scope="col" class="text-center">
                        @php
                            $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                            $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{$nilaiKeterampilan}}
                    </td>
                    <td scope="col" class="text-center">
                        {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                    </td>
                    @endif
                @endforeach

                @foreach ($levelsubjects as $levelsubject)
                    @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                    <td scope="col" class="text-center">
                        @php
                            $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                            $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{$nilaiAngka}}
                    </td>
                    <td scope="col" class="text-center">
                            {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                    </td>

                    <td scope="col" class="text-center">
                        @php
                            $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                            $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{$nilaiKeterampilan}}
                    </td>
                    <td scope="col" class="text-center">
                        {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                    </td>
                    @endif
                @endforeach

                @foreach ($levelsubjects as $levelsubject)
                    @if ($levelsubject->kategori == "Muatan Lokal")
                    <td scope="col" class="text-center">
                        @php
                            $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                            $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{$nilaiAngka}}
                    </td>
                    <td scope="col" class="text-center">
                            {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}} 
                    </td>
                    <td scope="col" class="text-center">
                        @php
                            $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                            $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                            $jumlahData++;
                        @endphp
                        {{$nilaiKeterampilan}}
                    </td>
                    <td scope="col" class="text-center">
                        {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                    </td>
                    
                    @endif
                @endforeach
                <td class="text-center">{{ round($jumlahNilaiAngkaPerSiswa + $jumlahNilaiKeterampilanPerSiswa) }}</td>
                <td class="text-center">{{ round(($jumlahNilaiAngkaPerSiswa + $jumlahNilaiKeterampilanPerSiswa)/$jumlahData) }}</td>
                <td class="text-center">{{ranking($student->student_id,Year::thisSemester()->id)->rank}}</td>
            </tr>
            
            
        @endforeach
        <tr>
            @php
                $totalRata2KelasPerMapel = 0;
                $jumlahData = 0;
            @endphp
            <th class="text-right" colspan="6">Rata-Rata Kelas</th>
            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += Score::avgPracticePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(Score::avgPracticePerClass($levelsubject->id))}}
                </th>

                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += Score::avgPracticePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(Score::avgPracticePerClass($levelsubject->id))}}
                </th>
                @endif
            @endforeach

            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += Score::avgPracticePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(Score::avgPracticePerClass($levelsubject->id))}}
                </th>

                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += Score::avgPracticePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(Score::avgPracticePerClass($levelsubject->id))}}
                </th>
                @endif
            @endforeach

            @foreach ($levelsubjects as $levelsubject)
                @if ($levelsubject->kategori == "Muatan Lokal")
                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += avKnowledgePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(avKnowledgePerClass($levelsubject->id))}}
                </th>

                <th colspan="2" class="text-center">
                    @php
                        $totalRata2KelasPerMapel += Score::avgPracticePerClass($levelsubject->id);
                        $jumlahData++;
                    @endphp
                    {{round(Score::avgPracticePerClass($levelsubject->id))}}
                </th>
                @endif
            @endforeach
            <th class="text-center">
                {{round($totalRata2KelasPerMapel)}}
            </th><th class="text-center">
                {{round($totalRata2KelasPerMapel/$jumlahData)}}
            </th><th class="text-center">
                {{round($totalRata2KelasPerMapel)}}
            </th>
        </tr>
        
    </tbody>
</table>