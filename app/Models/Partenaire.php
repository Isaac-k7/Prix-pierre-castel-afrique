<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use App\Models\User;

class Partenaire extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partenaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
