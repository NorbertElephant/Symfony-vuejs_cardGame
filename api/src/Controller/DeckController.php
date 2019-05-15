<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Repository\DeckModelRepository;
use App\Entity\DeckModel as Deck;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class DeckController extends AbstractController
{   
    const DECK_CINEMA = 1;
    const DECK_CUISINE = 2;

    public function __construct(DeckModelRepository $repo)
    {
        $this->repo = $repo;
    }

    
    /**
     * Récup que les decks de l'user Connecté (pour aller plus vite dans le dév du jeu )
     * @Route("/deck", name="deck")
     */
    public function index()
    {
        $user_connect =$this->get('security.token_storage')->getToken()->getUser()->getId();

        $all_decks = $this->repo->findAll();
        $decks = [];
        foreach ($all_decks as $deck) {
            foreach ($deck->getUser()->toArray() as $key => $user) {
                if ($user->getId() == $user_connect) {
                    $decks[] = $deck;
                 }
            }
           
        }

        return $this->render('deck/index.html.twig', [
            'title' => 'DoG Listing des Decks',
            'mainNavDeck' => true, 
            'decks'=> $decks,
        ]);


       
    }
      /**
     * Récup que les decks de l'user Connecté (pour aller plus vite dans le dév du jeu )
     * @Route("/deck/create_deck_cinema", name="AddDeckCinema")
     */
    public function AddDeckCinema( ObjectManager $manager, UserRepository $repoUser){

        // User qui crée le deck 
        $user_connect =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $user = $repoUser->find($user_connect);

        // Création du Deck avec ID 
        $deck = new Deck();

        $deck->setName('Cinema');

        $date = new \DateTime('@'.strtotime('now'));
 

        $deck->setCreatedAt($date);
        //Création lien entre deck Model et User
        $deck->addUser($user);

        // Création du ConsistOf 
        $deck_cinema = $this->repo->find( self:: DECK_CINEMA);
        foreach ($deck_cinema->getConsist()->toArray() as $card) {
            $deck->addConsist($card);
        }
       


        $manager->persist($deck);
        $manager->flush();

        

        

    
        

        
        
        $this->addFlash('success', 'Création réussi du deck Cinema pour ce User');

        return $this->redirectToRoute( 'deck' );


    }
}
