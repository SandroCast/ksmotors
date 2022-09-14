<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    use HasFactory;

    protected $table = 'vendas_produtos';


    public function user(){
        return $this->belongsTo('App\Models\User',  'id_user', 'id');
    }

    public function produto(){
        return $this->belongsTo('App\Models\Product',  'id_produto', 'id');
    }

}
