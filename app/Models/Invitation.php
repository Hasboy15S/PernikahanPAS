<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_invitation';
    protected $table = 'invitations';
    protected $fillable = [
        'nama',
        'email',
        'jml_hadir',
        'message',
        'code_qr',
        'status'
    ];
}
