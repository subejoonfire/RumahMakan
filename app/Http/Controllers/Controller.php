<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\barang;
use App\Models\riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    public function login(Request $request)
    {
        $check = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($check)) {
            $level = akun::where(
                'username',
                '=',
                $request->username,
                'AND',
                'password',
                '=',
                $request->password
            )->first();
            $user = akun::find($level->idakun);
            Session::put([
                'idakun' => $user->idakun,
                'username' => $user->username,
                'level' => $user->level
            ]);
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }
    function barangKeluar(Request $request)
    {
        $barang = barang::where('idbarang', '=', $request->Nomor)->first();
        if ($barang == NULL) {
            return redirect()->back()->with('fail', 'Barang tidak ada');
        } else {
            if (!is_numeric($request->Jumlah) || !is_numeric($request->Nomor)) {
                return redirect()->back()->with('fail', 'Yang dimasukkan harus angka');
            } elseif (empty($request->Jumlah) || empty($request->Nomor)) {
                return redirect()->back()->with('fail', 'Gagal');
            } elseif ($request->Jumlah < 0 || $request->Nomor < 1) {
                return redirect()->back()->with('fail', 'Masukkan angka yang benar');
            } else {
                $stok = $barang->stok - $request->Jumlah;
                if ($stok < 0) {
                    return redirect()->back()->with('fail', 'Gagal');
                } else {
                    barang::where('idbarang', $request->Nomor)->update([
                        'stok' => htmlspecialchars($stok)
                    ]);
                    riwayat::insert([
                        'idbarang' => $request->Nomor,
                        'nmbarang' => htmlspecialchars($barang->nmbarang),
                        'idakun' => session()->get('idakun'),
                        'username' => session()->get('username'),
                        'stok' => htmlspecialchars($stok),
                        'harga' => htmlspecialchars($barang->harga),
                        'kategori' => htmlspecialchars($barang->kategori),
                        'catatan' => 'Mengurangi barang',
                        'waktu' => now()
                    ]);
                    return redirect()->back()->with('sukses', 'Berhasil');
                }
            }
        }
    }
    function barangMasuk(Request $request)
    {
        $barang = barang::where('idbarang', '=', $request->Nomor)->first();
        if ($barang == NULL) {
            return redirect()->back()->with('fail', 'Barang tidak ada');
        } else {
            if (!is_numeric($request->Jumlah) || !is_numeric($request->Nomor)) {
                return redirect()->back()->with('fail', 'Yang dimasukkan harus angka');
            } elseif (empty($request->Jumlah) || empty($request->Nomor)) {
                return redirect()->back()->with('fail', 'Gagal');
            } elseif ($request->Jumlah < 0 || $request->Nomor < 1) {
                return redirect()->back()->with('fail', 'Masukkan angka yang benar');
            } else {
                $stok = $barang->stok + $request->Jumlah;
                if ($stok < 0) {
                    return redirect()->back()->with('fail', 'Gagal');
                } else {
                    barang::where('idbarang', $request->Nomor)->update([
                        'stok' => htmlspecialchars($stok)
                    ]);
                    riwayat::insert([
                        'idbarang' => $request->Nomor,
                        'nmbarang' => htmlspecialchars($barang->nmbarang),
                        'idakun' => session()->get('idakun'),
                        'username' => session()->get('username'),
                        'stok' => htmlspecialchars($stok),
                        'harga' => htmlspecialchars($barang->harga),
                        'kategori' => htmlspecialchars($barang->kategori),
                        'catatan' => 'Menambah barang',
                        'waktu' => now()
                    ]);
                    return redirect()->back()->with('sukses', 'Berhasil');
                }
            }
        }
    }
    function tambahBarang(Request $request)
    {
        $Harga = str_replace('.', '', $request->Harga);
        if (is_numeric($request->Kategori)) {
            return redirect()->back()->with('fail', 'Kategori tidak boleh angka');
        } elseif ($request->Harga < 0 || $request->Jumlah < 0) {
            return redirect()->back()->with('fail', 'Masukkan angka yang benar');
        } elseif (!is_numeric($Harga) || !is_numeric($request->Jumlah)) {
            return redirect()->back()->with('fail', 'Masukkan nilai yang benar');
        } else {
            $idbarang = Barang::count();
            barang::insert([
                'nmbarang' => htmlspecialchars($request->Nama),
                'stok' => htmlspecialchars($request->Jumlah),
                'harga' => htmlspecialchars($Harga),
                'kategori' => htmlspecialchars($request->Kategori),
                'status' => 'Tersedia'
            ]);
            riwayat::insert([
                'idbarang' => $idbarang + 1,
                'nmbarang' => htmlspecialchars($request->Nama),
                'idakun' => session()->get('idakun'),
                'username' => session()->get('username'),
                'stok' => htmlspecialchars($request->Jumlah),
                'harga' => htmlspecialchars($Harga),
                'kategori' => htmlspecialchars($request->Kategori),
                'catatan' => 'Menambah barang',
                'waktu' => now()
            ]);
            return redirect()->back()->with('sukses', 'Berhasil');
        }
    }
    function hapusBarang(Request $request)
    {
        $barang = barang::where('idbarang', '=', $request->id)->first();
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        barang::where('idbarang', '=', $request->id)->delete();
        riwayat::insert([
            'idbarang' => $request->id,
            'nmbarang' => htmlspecialchars($barang->nmbarang),
            'idakun' => session()->get('idakun'),
            'username' => session()->get('username'),
            'stok' => htmlspecialchars($barang->stok),
            'harga' => htmlspecialchars($barang->harga),
            'kategori' => htmlspecialchars($barang->kategori),
            'catatan' => 'Menghapus barang',
            'waktu' => now()
        ]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        return redirect()->back()->with('sukses', 'Berhasil');
    }
    function editBarangAction(Request $request)
    {
        $Harga = str_replace('.', '', $request->Harga);
        if (!is_numeric($Harga)) {
            return redirect()->back()->with('fail', 'Harga harus angka');
        } else {
            barang::where('idbarang', '=', session()->get('idbarang'))->update([
                'nmbarang' => htmlspecialchars($request->Nama),
                'harga' => htmlspecialchars($Harga),
                'kategori' => htmlspecialchars($request->Kategori),
            ]);
            riwayat::insert([
                'idbarang' => session()->get('idbarang'),
                'nmbarang' => htmlspecialchars($request->Nama),
                'idakun' => session()->get('idakun'),
                'username' => session()->get('username'),
                'stok' => session()->get('stok'),
                'harga' => htmlspecialchars($Harga),
                'kategori' => htmlspecialchars($request->Kategori),
                'catatan' => 'Mengedit barang',
                'waktu' => now()
            ]);
            return redirect()->back()->with('sukses', 'Berhasil');
        }
    }
    function hapusRiwayat()
    {
        riwayat::truncate();
        return redirect()->back()->with('sukses', 'Berhasil');
    }
}
