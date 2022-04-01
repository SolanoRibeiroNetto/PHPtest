<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cep extends Model
{
    use HasFactory;
    
    protected $table = 'ceps';

    protected $fillable = ['cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf'];

}
