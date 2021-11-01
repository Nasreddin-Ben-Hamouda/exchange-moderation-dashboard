<?php
namespace App\Services;

use App\Repositories\CommentRepository;

/*
   Cette classe est une classe qui sera utilisée par la classe controleur correspondante
   et elle utilise la classe repository correspondante,
   elle agit comme un classe intermédiaire entre les deux classes controleur et repository
   Cette classe se charge principalement du formatage du résultat retourné par la méthode correspondate 
   de class repository utilisée
*/
class CommentService {
  protected $commentRepo;
  public function __construct(CommentRepository $commentRepo){
    $this->commentRepo = $commentRepo;
  } 

  public function getLastNSignaledComments(int $n= 5) {
    return $this->commentRepo->getLastNSignaledComments();
  }
  
}