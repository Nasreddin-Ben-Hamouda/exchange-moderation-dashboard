<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente un topic = thématique puisque un poste peut parler de plusieurs topic (exemple: informatique, high tech, électronique ,...)

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class Topic extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function posts() {
        return $this->belongsToMany(
            Topic::class,
            "post_topic",
            "topic_id",
            "post_id",
        );
    }

    public function user(){
        return $this->belongsTo(BlogUser::class,"created_by");
    }
}
