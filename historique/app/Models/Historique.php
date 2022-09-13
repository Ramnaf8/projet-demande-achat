<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['user_id', 'produit_id', 'quantite', 'prix_total'];
}
