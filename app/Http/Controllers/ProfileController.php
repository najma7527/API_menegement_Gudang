<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Kosong: tanpa middleware
    }

    public function show(Request $request)
    {
        $user = $request->user();
        
        // Pastikan URL foto profil lengkap
        if ($user->profile_photo) {
            if (!str_starts_with($user->profile_photo, 'http')) {
                $user->profile_photo = asset('storage/' . $user->profile_photo);
            }
        }
        
        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle upload foto
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                $oldPhotoPath = str_replace(asset('storage/'), '', $user->profile_photo);
                if (Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }
            
            // Simpan foto baru
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Pastikan URL lengkap untuk response
        $user->profile_photo = $user->profile_photo 
            ? asset('storage/' . $user->profile_photo)
            : null;

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'user' => $user,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $authHeader = $request->header('Authorization');
        $user = $this->getUserFromToken($authHeader);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!$request->hasFile('profile_photo')) {
            return response()->json(['message' => 'Tidak ada foto dikirim'], 400);
        }

        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        $userModel = User::find($user->id);
        $userModel->profile_photo = $path;
        $userModel->save();

        return response()->json([
            'message' => 'Foto profil berhasil diperbarui',
            'photo_url' => asset('storage/' . $path),
        ]);
    }

    // 🔍 Ambil user dari token (tanpa middleware sanctum)
    private function getUserFromToken($authHeader)
    {
        if (!$authHeader || !str_contains($authHeader, 'Bearer ')) {
            return null;
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $user = DB::table('personal_access_tokens')
            ->join('users', 'users.id', '=', 'personal_access_tokens.tokenable_id')
            ->where('personal_access_tokens.token', hash('sha256', $token))
            ->select('users.*')
            ->first();

        return $user;
    }
}