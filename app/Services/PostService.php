<?php
namespace App\Services;
use App\Repositories\PostRepository;

/*
   Cette classe est une classe qui sera utilisée par la classe controleur correspondante 
   et elle utilise la classe repository correspondante,
   elle agit comme un classe intermédiaire entre les deux classes controleur et repository
   Cette classe se charge seulement à travers une seule méthode de retourner la liste des postes signalés
*/
class PostService {
   protected $postRepo;

   public function __construct(PostRepository $postRepo){
      $this->postRepo = $postRepo;
   } 

   public function getLastNSignaledPosts(int $n= 5) {
      return $this->postRepo->getLastNSignaledPosts();
   }
}
?>