<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle Vote de poids , puisque un poste peut subir / recevoir plusieurs vote de poids (sorte de rating)

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class WeightVote extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function user(){
        return $this->belongsTo(BlogUser::class,"user_id");
    }

    public function post(){
        return $this->belongsTo(Post::class,"post_id");

    }
}
