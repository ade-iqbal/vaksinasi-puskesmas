<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Vaksinasi;
use App\Models\Vaksin;
use App\Models\Detail_Vaksin;
use Illuminate\Support\Str;


class VaksinasiController extends Controller
{
    public function index()
    {
        $vaksinasi = Pasien::join("vaksinasi", "pasien.nik", "=", "vaksinasi.nik")
                             ->where('vaksinasi.status', 2)
                             ->groupBy('pasien.nik')
                             ->orderBy('pasien.nama_pasien')
                             ->get();

        return view("vaksinasi.vaksinasi", compact('vaksinasi'));
    }

    public function print()
    {
        $vaksinasi = Vaksinasi::join("pasien", "pasien.nik", "=", "vaksinasi.nik")
            ->join("vaksin", "vaksin.id", "=", "vaksinasi.id_vaksin")
            ->where('vaksinasi.status', 2)
            ->orderBy('vaksinasi.tgl_vaksin', 'ASC')
            ->get();
        return view("vaksinasi.print", compact('vaksinasi'));
    }


    public function detail($nik)
    {
        $pasien = Pasien::find($nik);
        $vaksinasi = Vaksinasi::join("vaksin", "vaksin.id", "=", "vaksinasi.id_vaksin")
                                ->select('vaksinasi.*', 'vaksin.nama_vaksin')
                                ->where('vaksinasi.nik', $nik)
                                ->get();

        return view("vaksinasi.detail_vaksinasi", compact('pasien', 'vaksinasi'));
    }

    public function edit($nik)
    {
        $detail = Pasien::find($nik);
        return view("vaksinasi.edit_vaksinasi", compact('detail'));
    }

    public function tambah()
    {
        return view("vaksinasi.tambah_vaksinasi");
    }

    public function update_pasien(Request $request)
    {
        $pasien = Pasien::find($request->nik);
        $pasien->nik = htmlspecialchars(trim($request->nik));
        $pasien->nama_pasien = ucwords(htmlspecialchars(trim($request->nama_pasien)));
        $pasien->tgl_lahir = htmlspecialchars(trim($request->tgl_lahir));
        $pasien->jenis_kelamin = htmlspecialchars(trim($request->jenis_kelamin));
        $pasien->no_hp = htmlspecialchars(trim($request->no_hp));
        $pasien->email = isset($request->email) ? htmlspecialchars(trim($request->email)) : NULL;
        $pasien->alamat = htmlspecialchars(trim($request->alamat));
        $pasien->riwayat_penyakit = isset($request->riwayat_penyakit) ? htmlspecialchars(trim($request->riwayat_penyakit)) : NULL;
        $pasien->save();

        return redirect()->route('vaksinasi.detail', ['nik' => $pasien->nik])->with('success', 'Data berhasil diubah');
    }

    public function delete_pasien(Request $request)
    {
        $pasien = Pasien::find($request->nik);
        $pasien->delete();
        // dd($request);

        return redirect()->back()->with('success', 'data pasien berhasil dihapus');
    }

    public function delete_vaksinasi(Request $request)
    {
        $vaksinasi = Vaksinasi::find($request->id);
        $vaksinasi->delete();
        // dd($request);

        return redirect()->back()->with('success', 'data vaksinasi berhasil dihapus');
    }
}
