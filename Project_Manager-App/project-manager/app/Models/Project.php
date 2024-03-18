<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
