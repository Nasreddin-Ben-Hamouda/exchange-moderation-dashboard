<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente l' opération du signal sur un commentaire déclenché par un utilisater

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class CommentSignal extends Model
{
    use HasFactory;

    protected $table = "comment_signals";


    public function signalerUser(){
        return $this->belongsTo(BlogUser::class,"user_id");
    }

    public function signaledComment() {
        return $this->belongsTo(Comment::class,"comment_id");
    }
}
