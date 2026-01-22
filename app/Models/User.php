<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'profile_photo_url'
    ];

    /**
     * Aksesor untuk URL foto profil lengkap
     */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if (empty($attributes['profile_photo'])) {
                    return null;
                }
                
                // Jika sudah URL lengkap, return langsung
                if (str_starts_with($attributes['profile_photo'], 'http')) {
                    return $attributes['profile_photo'];
                }
                
                // Bangun URL lengkap untuk storage
                return asset('storage/' . $attributes['profile_photo']);
            }
        );
    }

    /**
     * Aksesor untuk memastikan kompatibilitas dengan response sebelumnya
     */
    public function getProfilePhotoAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // Jika sudah URL lengkap, return langsung
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        
        // Untuk menjaga kompatibilitas, return path relative
        // URL lengkap akan tersedia via profile_photo_url
        return $value;
    }
}