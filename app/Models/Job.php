<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Campos asignables en masa
    protected $fillable = [
        'title',
        'description',
        'location',
        'company_name',
        'salary',
        'status',
        'image',
        'numero_whatsapp',
        'user_id', // Importante incluir el user_id
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class); // Relación inversa con el usuario
    }
}
