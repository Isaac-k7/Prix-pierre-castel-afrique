<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Str;


class Candidature extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidatures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pays_id',
        'status',
        'preselected',
        'editions_id',
        'lien_rx',
        'accepted_by',
        'update_count',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function acceptedBy(){
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function pays(){
        return $this->belongsTo(Pays::class,'pays_id');
    }
    public function edition(){
        return $this->belongsTo(Edition::class,'editions_id');
    }

}
