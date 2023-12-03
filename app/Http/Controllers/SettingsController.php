<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => Setting::where('key', 'title')->first(),
            'sub_title' => Setting::where('key', 'sub_title')->first(),
            'logo_web' => Setting::where('key', 'logo_web')->first(),
            'favicon' => Setting::where('key', 'favicon')->first(),
            'meta_google' => Setting::where('key', 'meta_google')->first(),
            'no_sertification' => Setting::where('key', 'no_sertification')->first(),
            'count_rubrik' => Setting::where('key', 'count_rubrik')->first(),
            'facebook' => Setting::where('key', 'facebook')->first(),
            'x' => Setting::where('key', 'x')->first(),
            'youtube' => Setting::where('key', 'youtube')->first(),
            'instagram' => Setting::where('key', 'instagram')->first(),
            'email' => Setting::where('key', 'email')->first(),
            'no_hp' => Setting::where('key', 'no_hp')->first(),
            'alamat' => Setting::where('key', 'alamat')->first(),
        ];
        return view('settings.general', $data);
    }

    public function footer(Request $request)
    {
        $data = [
            'our_about' => Setting::where('key', 'our_about')->first(),
            'redaction' => Setting::where('key', 'redaction')->first(),
            'code_pers' => Setting::where('key', 'code_pers')->first(),
            'pedoman_cyber' => Setting::where('key', 'pedoman_cyber')->first(),
            'code_etik' => Setting::where('key', 'code_etik')->first(),
            'lowongan_kerja' => Setting::where('key', 'lowongan_kerja')->first(),
            'security_user' => Setting::where('key', 'security_user')->first(),
            'job' => Setting::where('key', 'job')->first(),
        ];
        return view('settings.footer', $data);
    }

    public function update(Request $request)
    {
        // Ambil nilai dari tombol yang diklik
        $action = $request->input('action');
        if ($action == 'updategeneral') {
            // Pastikan file ada sebelum melakukan operasi upload
            if ($request->hasFile('logo_web')) {
                $file = $request->file('logo_web');
                $imageName = date('dmY') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/logo', $imageName);

                Setting::updateOrCreate(['key' => 'logo_web'], ['value' => $imageName]);
            }

            // Pastikan file ada sebelum melakukan operasi upload favicon
            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $faviconImageName = $file->getClientOriginalName();
                $path = $file->storeAs('public/favicon', $faviconImageName);

                Setting::updateOrCreate(['key' => 'favicon'], ['value' => $faviconImageName]);
            }

            foreach ($request->all() as $key => $value) {
                $value = $value ?: null;
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        } elseif ($action == 'updatefooter') {
            foreach ($request->all() as $key => $value) {
                $value = $value ?: null;
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }
        return redirect()->back()->with('success', 'Berhasil update web setting');
    }
}
