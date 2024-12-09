<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.pages.profile.index');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('admin.pages.profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {

        $request->validate([
            'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255',
			'phone' => 'required|string|max:255',
			'job_position' => 'required|string|max:255',
			'born_date' => 'required',
			'address' => 'required|string|max:255',
            'file' => 'mimes:png,jpg,jpeg,gif|max:5000'
        ]);

        $user = User::find(Auth::user()->id);

        // Mengupdate data pengguna dengan data yang diterima dari request
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->job_position = $request->job_position;
        $user->born_date = $request->born_date;
        $user->address = $request->address;

        // Jika ada file yang diunggah, menyimpannya dan mengupdate foto profil
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/img/profile'), $fileName); // Menyimpan file ke dalam penyimpanan
            $user->photo = url('/img/profile/'.$fileName); // Mengupdate foto profil pengguna
        }

        // Menyimpan perubahan data pengguna
        $user->save();

        return Redirect::route('admin.profile.edit');
    }

    public function reset(Request $request)
    {
        if($request->password_new != $request->password_new_conf){
            return redirect()->route('admin.profile.edit')->with('error', 'Password baru harus sama dengan password konfirmasi');
        }
        $user = User::find(Auth::user()->id);
        
        if(!Hash::check($request->password, $user->password)){
            return redirect()->route('admin.profile.edit')->with('error', 'Password lama salah');
        }

        // Mengupdate data pengguna dengan data yang diterima dari request
        $user->password = Hash::make($request->password_new);
        $user->save();
        return redirect()->route('admin.profile.edit')->with('success', 'berhasil mengganti password');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
