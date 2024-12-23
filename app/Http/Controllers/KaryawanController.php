<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\table;

class KaryawanController extends Controller
{
  public function store(Request $request)
  {
      $request->validate([
          'nisn' => 'required|unique:karyawan,nisn',
          'nama_lengkap' => 'required',
          'jabatan' => 'required',
          'no_hp' => 'required',
          'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      $nisn = $request->nisn;
      $nama_lengkap = $request->nama_lengkap;
      $jabatan = $request->jabatan;
      $no_hp = $request->no_hp;
      $password = $request->has('password') ? Hash::make($request->password) : Hash::make('12345');
      $foto = null;

      if ($request->hasFile('foto')) {
          $foto = $nisn . '.' . $request->file('foto')->getClientOriginalExtension();
      }

      try {
          $data = [
              'nisn' => $nisn,
              'nama_lengkap' => $nama_lengkap,
              'jabatan' => $jabatan,
              'no_hp' => $no_hp,
              'foto' => $foto,
              'password' => $password
          ];

          $cek = DB::table('karyawan')->where('nisn', $nisn)->exists();
          if ($cek) {
              return Redirect::back()->with(['warning' => 'NISN sudah digunakan']);
          }

          $simpan = DB::table('karyawan')->insert($data);
          if ($simpan) {
              if ($request->hasFile('foto')) {
                  $folderPath = "public/uploads/karyawan/";
                  $request->file('foto')->storeAs($folderPath, $foto);
              }
              return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
          }
      } catch (\Exception $e) {
          \Log::error('Error while saving data: ' . $e->getMessage());
          return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
      }
  }

}
