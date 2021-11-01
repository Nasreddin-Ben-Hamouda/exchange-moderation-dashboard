<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente l' opération du signal sur un poste déclenché par un utilisater

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class PostSignal extends Model
{
    use HasFactory;

    protected $table = "post_signals";

    public function signalerUser(){
        return $this->belongsTo(BlogUser::class,"user_id");
    }

    public function signaledPost() {
        return $this->belongsTo(Post::class,"post_id");
    }
}
