<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['user_id', 'produit_id', 'quantite', 'prix_total'];
}
