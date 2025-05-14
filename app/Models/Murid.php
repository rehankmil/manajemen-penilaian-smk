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
    protected $fillable = ['nama', 'nis', 'nama', 'no_telp', 'jenis_kelamin', 'tgl_lahir', 'avatar','kelas_id', 'user_id'];

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
}
