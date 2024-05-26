<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /* protected $fillable = [
        'name',
        'email',
        'password',
    ]; */
    protected $guarded = ["id"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }

    protected $with = ['pasien', 'dokter', 'perawat'];

    public function pasien(): HasOne {
        return $this->hasOne(Pasien::class, 'id_user');
    }
    
    public function dokter(): HasOne {
        return $this->hasOne(Dokter::class, 'id_user');
    }
    
    public function perawat(): HasOne {
        return $this->hasOne(Perawat::class, 'id_user');
    }
    
    public function admin(): HasOne {
        return $this->hasOne(Admin::class, 'id_user');
    }
}