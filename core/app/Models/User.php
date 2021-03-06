<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuids, HasApiTokens;

    protected $fillable = [
        'username', 'email', 'phone', 'first_name', 'last_name', 'avatar', 'phone_verified_at', 'email_verified_at', 'last_login', 'status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];
    /**
     * returns the public url on avatar
     */
    public function getAvatarPublicUrl(): string
    {
        if ($this->avatar)
            return (env('AWS_PATH') . '/' . $this->avatar);
        else return "sample-avatar.png";
    }
    /**
     * updates avatar from given file
     */
    public function updateAvatar($file): bool
    {
        $current = $this->avatar;
        $this->avatar = Storage::cloud()->put('/avatars', $file);
        $this->save();
        Storage::cloud()->delete($current);
        return true;
    }
    /**
     * updates avatar from a url
     */
    public function updateAvatarFromUrl(string $url): bool
    {
        $contents = file_get_contents($url);
        return $this->updateAvatar($contents);
    }
}
