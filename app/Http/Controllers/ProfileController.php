<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        
    }

    public function show(Request $request)
{
    $user = $request->user();
    
    $base64Image = null;
    if ($user->profile_photo) {
        $path = $user->profile_photo;
        if (Storage::disk('public')->exists($path)) {
            $imageContent = Storage::disk('public')->get($path);
            $base64Image = 'data:image/jpeg;base64,' . base64_encode($imageContent);
        }
    }
    
    return response()->json([
        'user' => array_merge($user->toArray(), [
            'profile_photo_base64' => $base64Image,
        ]),
    ]);
}

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:5120', // 5MB
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

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                $oldPhotoPath = $user->profile_photo;
                
                // Hanya hapus jika file ada di storage lokal
                if (!str_starts_with($oldPhotoPath, 'http') && 
                    Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }
            
            // Simpan foto baru
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Reload user untuk mendapatkan profile_photo_url terbaru
        $user->refresh();

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'user' => $user,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            $oldPhotoPath = $user->profile_photo;
            if (!str_starts_with($oldPhotoPath, 'http') && 
                Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }
        }

        // Simpan foto baru
        $file = $request->file('profile_photo');
        $path = $file->store('profile_photos', 'public');
        $user->profile_photo = $path;
        $user->save();

        // Reload untuk mendapatkan URL lengkap
        $user->refresh();

        return response()->json([
            'message' => 'Foto profil berhasil diperbarui',
            'user' => $user,
        ]);
    }

    /**
     * Hapus foto profil
     */
    public function deletePhoto(Request $request)
    {
        $user = $request->user();

        if ($user->profile_photo) {
            $oldPhotoPath = $user->profile_photo;
            if (!str_starts_with($oldPhotoPath, 'http') && 
                Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }
            
            $user->profile_photo = null;
            $user->save();
        }

        return response()->json([
            'message' => 'Foto profil berhasil dihapus',
            'user' => $user,
        ]);
    }
}