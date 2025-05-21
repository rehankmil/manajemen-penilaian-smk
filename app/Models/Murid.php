<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murid';
    protected $primaryKey = 'id';
    protected $fillable = ['nis', 'nama', 'no_telp', 'jenis_kelamin', 'tgl_lahir', 'avatar','kelas_id', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai(): HasMany
    {
        return $this->HasMany(Nilai::class, 'murid_id');
    }

     /**
     * Scope a query to search murid based on criteria.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nis', 'LIKE', "%{$search}%")
                  ->orWhere('no_telp', 'LIKE', "%{$search}%")
                  ->orWhereHas('kelas', function($q) use ($search) {
                      $q->where('kode', 'LIKE', "%{$search}%")
                        ->orWhere('nama', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        return $query;
    }
}
