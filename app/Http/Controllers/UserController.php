<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
/*
 Ce controleur http se charge de la gestion des modérateurs & super modérateurs du tableau de bord
*/
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    private static  $rules = [
            'name' => ['required', 'string', 'max:255','regex:/[a-zA-Z]+\s[a-zA-Z]+/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed','min:8'],
    ];

   /*
     Cette méthode affiche la liste des modérateur & super modérateurs
   */
    public function index(User $model)
    {
      return view('users.index', ['users' => $model->cursorPaginate(10)]);
    }

   /*
     Cette méthode permet de retourner une vue de création d'un nouveau modérateur
   */
    public function create() {
        return view('users.create');
    }


    //customizing error message for storing new moderator
    public function messages()
    {
        return [
            'name.required' => 'Le champs Nom Prenom est obligatoire ! ',
            "name.max" => "au maximun 255 caractéres sont alloués!",
            "name.regex"=>"le champs Nom prenom doit contenir le Nom et le prénom séparés par un espace",
            'email.required' => 'Le champs email est obligatoire ! ',
            "email.max" => "au maximun 255 caractéres sont alloués!",
            "email.unique"=>"un autre compte utilise déja cette adresse email!",
            "email.email" =>"veuillez s'il vous plait entrer un format d'email valide !",
            "password.required"=>"le champs mot de passe est obligatoire!",
            "password.min"=>"le champs mot de passe doit contenir au minimum 8 caractéres!",
            "password.confirmed" => "le mot de passe de confirmation est erroné"
       ];
    }

   /*
     Cette méthode permet de créer/ enregistrer un nouveau modérateur
   */
    public function store(Request $request) {

        $this->validate($request,$this::$rules,$this->messages());

        $moderator = User::create([
         "name"=>$request->input("name"),
         "email"=>$request->input("email"),
         "password" => Hash::make($request->input("password")),
         "role" => User::$rolesMapper['MODERATOR']
        ]);
        return redirect()->back()
           ->with("success_msg","le modérateur a été crée avec success")
           ->with("email",$request->input("email"))
           ->with("password",$request->input("password"));
    }

    public function edit(int $id) {
       $moderator = User::findOrFail($id);
       return view("users.edit")->with("moderator",$moderator);
    }


   /*
     Cette méthode permet de mettre à jour les informations personnelles d'un modérateur
   */
    public function update(Request $request,$id) {
       $validationRules = $this::$rules;
       unset($validationRules["password"]);

       $user  = User::find($id);

       if($user->email == $request->input("email"))
          unset($validationRules["email"]);

       $this->validate($request,$validationRules,$this->messages());

       User::where("id",$id)->update([
          "name" => $request->input("name"),
          "email"=> $request->input("email")
       ]);

       return redirect()->back()
       ->with("success_msg","le modérateur a été mis à jour avec success");
    }


   /*
     Cette méthode permet de supprimer un modérateur
   */
    public function destroy(User $user) {
        $user->delete();
        return redirect(URL("user"))->with("success_msg","le modérateur a été supprimé avec success");
    }
}
