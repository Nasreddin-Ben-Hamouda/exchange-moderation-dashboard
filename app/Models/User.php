<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/*
  Cette classe décrit le modéle modérateur ou super modérateur (utilisateur du tableau de bord = gestionnaire = desicion maker)
  ON remarque la présence de l'attribut   | protected $connection = "mysql"; | dans cette classe
  puisque ce modéle de données sera hydraté par les données qui se trouvent dans la BD des modérateurs du blog
  et on se connecte a cette dernière en utilisant la socket de connexion  nommé 'mysql' , tandis que tous les autres modéles de données se connectent
  à la BD avec une socket de connexion nommée 'mysql2'

  Les noms des méthodes ci-dessous seront utilisées pour accéder au relations entre
  les modéles et servent donc à definir les associations/relations entre ces derniers
*/
class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //roles mapper

    public static $rolesMapper = ["MODERATOR"=>0,"SUPER_MODERATOR"=>1];

    public function isModerator() {
       return $this->role == $this::$rolesMapper["MODERATOR"];
    }

    public function isSuperModerator() {
        return $this->role == $this::$rolesMapper["SUPER_MODERATOR"];
    }

    protected $fillable = [
        'name',
        "role",
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
