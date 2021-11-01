<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente la session de connexion(nouvelle consultation/nouvelle visite ou nouvelle session http , depend de la logique adoptée) d'un utilisateur au blog

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class Session extends Model
{
    public $timestamps = false;
    use HasFactory;


    public function user() {
        return $this->belongsTo(BlogUser::class,"user_id");
    }
}
