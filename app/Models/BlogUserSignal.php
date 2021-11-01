<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Cette classe décrit le modéle qui représente l' opération du signal sur un utilisateur du blog declénché par un autre utilisater

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/

class BlogUserSignal extends Model
{
    use HasFactory;

    protected $table = "user_signals";

    public function signaledUser(){
        return $this->belongsTo(BlogUser::class,"signaled_id");
    }

    public function signalerUser() {
        return $this->belongsTo(BlogUser::class,"user_id");
    }

    public function context(){
      return $this->morphTo();
    }

}
