<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente un commentaire écrit par un utilisateur pour intéragir avec un poste publié sur le blog

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class Comment extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function user(){
        return $this->belongsTo(BlogUser::class,"user_id");
    }

    public function post() {
        return $this->belongsTo(Post::class,"post_id");

    }

    public function signalers() {
        return $this->belongsToMany(
            BlogUser::class,
            "comment_signals",
            "comment_id",
            "user_id"
        )->withPivot("created_at");
    }

    //for polymorphic relationship
    public function getSignalsWhenIamAContextOfAUserSignal(){
        return $this->morphMany(BlogUserSignal::class, 'context');
    }

}
