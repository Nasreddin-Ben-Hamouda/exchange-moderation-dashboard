<?php
namespace App\Services;
use App\Repositories\BlogUserRepository;
/*
   Cette classe est une classe qui sera utilisée par la classe controleur correspondante
   et elle utilise la classe repository correspondante,
   elle agit comme un classe intermédiaire entre les deux classes controleur et repository
   Cette classe se charge principalement du formatage du résultat retourné par la méthode correspondate 
   de class repository utilisée
*/
class BlogUserService  {
   // l'instance de la classe repository utilisée
    protected $blogUserRepo;

    //l'injection de dépendance(l'instance de la classe repository en question)
    public function __construct(BlogUserRepository $blogUserRepo){
       $this->blogUserRepo =  $blogUserRepo;
    }

    //invocation de la méthode correspondante de la classe repository (pas de logique métier supplémentaire)
    public function getLastNSignaledBlogUsers(int $n=5) {
       return $this->blogUserRepo->getLastNSignaledBlogUsers();
    }


   //invocation de la méthode correspondante de la classe repository (pas de logique métier supplémentaire)
    public function getBlacklistedProfiles($threshold,$from,$to){
       return $this->blogUserRepo->getBlacklistedProfiles($threshold,$from,$to);
    }
}