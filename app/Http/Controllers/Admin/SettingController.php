<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.user.setting', [
            'title' => 'Settings',
            'user' => Auth::user(),
        ]);
    }

    public function list()
    {
        $user = User::all();

        return view('admin.user.list', [
            'title' => 'List Users',
            'users' => $user,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'is_active' => 'required|boolean',
        ]);

        if (
            Auth::id() == $request->user_id &&
            $request->is_active == 0
        ) {
            return response()->json([
                'message' => 'Anda tidak dapat menonaktifkan akun yang sedang login'
            ], 403);
        }

        $user = User::findOrFail($request->user_id);
        $user->is_active = $request->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'status'   => 'required|in:0,1',
        ]);

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'email_verified_at' => null, // false
            'is_active'         => 1,
            'is_superadmin'     => $request->status,
        ]);

        return redirect()
            ->back()
            ->with('success', 'User berhasil ditambahkan');
    }

    public function updateAdmin(Request $request, $id)
    {
        // dd($request);
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
            'is_active' => 'required|boolean',
            'is_superadmin' => 'required|boolean',
        ]);

        // Data wajib update
        $data = [
            'name' => $request->name,
            'is_active' => $request->is_active,
            'is_superadmin' => $request->is_superadmin,
        ];

        // 🔐 HANYA update password kalau diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->back()
            ->with('success', 'User berhasil diperbarui');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // =========================
        // VALIDATION
        // =========================
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'wa' => 'nullable|string|max:20',
            'birth' => 'nullable|string|max:50',
            'lokasi' => 'nullable|string|max:255',

            // avatar
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            // password
            'current_password' => 'nullable',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'avatar.image' => 'Avatar must be an image',
            'avatar.max' => 'Avatar max size is 3MB',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->wa = $request->wa;
        $user->birth = $request->birth;
        $user->lokasi = $request->lokasi;

        // =========================
        // AVATAR UPLOAD
        // =========================
        if ($request->hasFile('avatar')) {

            // hapus avatar lama (jika ada)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store(
                'avatars',
                'public'
            );

            $user->avatar = $path;
        }

        if ($request->filled('password')) {

            // previous password wajib
            if (!$request->filled('current_password')) {
                return back()->withErrors([
                    'current_password' => 'Previous password is required'
                ])->withInput();
            }

            // cek password lama
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Previous password is incorrect'
                ])->withInput();
            }

            // simpan password baru
            $user->password = Hash::make($request->password);
        }

        // =========================
        // SAVE
        // =========================
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully');
    }
}
