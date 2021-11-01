<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\CommentSignal;
use App\Services\CommentService;
/*
 Ce Controleur http se charge de servir des fonctions en relation avec les commentaires
*/

class CommentStatsController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
        $this->middleware("auth");
    }

    /*
     Cette méthode se charge d'afficher un commentaire lorsqu'on fournit son ID dans la requete HTTP GET
    */
    public function show($id){
 
        return view("comment.show_one")
              ->with("comment", Comment::findOrFail($id));
    }

    /*
     Cette méthode se charge d'afficher tous les commentaires signalés avec une pagination de 10 par page
    */
    public function getLast5SignaledComments(){
        return view("comment.signaled_comments")
        ->with("data",$this->commentService->getLastNSignaledComments()->cursorPaginate(10));
    }


    /*
     Cette méthode se charge d'afficher les signals subis par commentaire donné en fournissant son ID dans le requete HTTP GET
    */
    public function getSignalsForComment($id){    
        $signals = CommentSignal::where("comment_id","=",$id)->orderBy("created_at","desc")->with(["signalerUser"])->cursorPaginate(10);
  
        return view("comment.associated_signals")
        ->with("signals",$signals)
        ->with("id",$id);
    }
}
