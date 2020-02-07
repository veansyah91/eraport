<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use File;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:staff',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'status_nikah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_terakhir' => 'required',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $staff = new Staff;
        $staff->nip = $request->nip;
        $staff->nama = $request->nama;
        $staff->tempat_lahir = $request->tempat_lahir;
        $staff->tgl_lahir = $request->tgl_lahir;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->agama = $request->agama;
        $staff->alamat = $request->alamat;
        $staff->status_nikah = $request->status_nikah;
        $staff->nama_pasangan = $request->nama_pasangan;
        $staff->pekerjaan_pasangan = $request->pekerjaan_pasangan;
        $staff->nip_pasangan = $request->nip_pasangan;
        $staff->nama_ibu = $request->nama_ibu;
        $staff->pendidikan_terakhir = $request->pendidikan_terakhir;
        $staff->jurusan = $request->jurusan;
        $staff->nim = $request->nim;
        $staff->tahun_masuk = $request->tahun_masuk;
        $staff->tahun_lulus = $request->tahun_lulus;
        $staff->ipk = $request->ipk;
        $staff->status_pegawai = $request->status_pegawai;
        $staff->tmt_pengangkatan = $request->tmt_pengangkatan;
        $staff->no_sk = $request->no_sk;
        $staff->tgl_sk = $request->tgl_sk;
        $staff->tmt_pns = $request->tmt_pns;
        $staff->no_sk_pns = $request->no_sk_pns;
        $staff->tgl_sk_berkala = $request->tgl_sk_berkala;
        $staff->tmt_sekolah = $request->tmt_sekolah;
        $staff->tgl_sk_sekolah = $request->tgl_sk_sekolah;
        $staff->no_sertifikasi = $request->no_sertifikasi;
        $staff->no_peserta_sertifikasi = $request->no_peserta_sertifikasi;
        $staff->nrg = $request->nrg;
        $staff->tgl_masuk_sekolah = $request->tgl_masuk_sekolah;
        if ($request->hasFile('image')) {
            $request->file('image')->move('img/staff', $request->file('image')->getClientOriginalName());
            $staff->image = $request->file('image')->getClientOriginalName();
        };
        $staff->save();
        return redirect('/staff')->with('status','Data Staff Berhasil Ditambahkan');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit',compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        
        Staff::where('id',$staff->id)
                ->update([
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
                    'status_nikah' => $request->status_nikah,
                    'nama_pasangan' => $request->nama_pasangan,
                    'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
                    'nip_pasangan' => $request->nip_pasangan,
                    'nama_ibu' => $request->nama_ibu,
                    'pendidikan_terakhir' => $request->pendidikan_terakhir,
                    'jurusan' => $request->jurusan,
                    'nim' => $request->nim,
                    'tahun_masuk' => $request->tahun_masuk,
                    'tahun_lulus' => $request->tahun_lulus,
                    'ipk' => $request->ipk,
                    'status_pegawai' => $request->status_pegawai,
                    'tmt_pengangkatan' => $request->tmt_pengangkatan,
                    'no_sk' => $request->no_sk,
                    'tgl_sk' => $request->tgl_sk,
                    'tmt_pns' => $request->tmt_pns,
                    'no_sk_pns' => $request->no_sk_pns,
                    'tgl_sk_berkala' => $request->tgl_sk_berkala,
                    'tmt_sekolah' => $request->tmt_sekolah,
                    'tgl_sk_sekolah' => $request->tgl_sk_sekolah,
                    'no_sertifikasi' => $request->no_sertifikasi,
                    'no_peserta_sertifikasi' => $request->no_peserta_sertifikasi,
                    'nrg' => $request->nrg,
                    'tgl_masuk_sekolah' => $request->tgl_masuk_sekolah,                    
                ]);

        if ($request->hasFile('image')) {
            File::delete('img/staff/'.$staff->image);
            $request->file('image')->move('img/staff/', $request->file('image')->getClientOriginalName());
            Staff::where('id',$staff->id)
                ->update([
                    'image' => $request->file('image')->getClientOriginalName()
                ]);
            
        };
        return redirect('/staff')->with('status','Data Staff Berhasil Diubah');
    }

    public function destroy(Staff $staff)
    {
        File::delete('img/'.$staff->image);
        Staff::destroy($staff->id);
        return redirect('/staff')->with('status','Data Staff Berhasil Dihapus');
    }
}
