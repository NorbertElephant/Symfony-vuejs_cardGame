<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Repository\CardModelRepository;
use App\Repository\TypeOfCardRepository;
use App\Entity\CardModel as Card;
use App\Form\CardType;
use App\Entity\TypeOfCard;

class CardController extends AbstractController
{

    const URL_BACK = './Uploads/background/background.png';
    const URL_CINEMA ='./Uploads/cards/cinema';
    const URL_CUISINE ='./Uploads/cards/cuisine';
    const CUISINE = 1; 
    const CINEMA = 2; 
    const COPYMAX_CARD_SPE = 1;
    const COPYMAX_CARD = 2;
    const CARD_SPE = 3;
    const IN_DECK = 0;
    
    /**
     * @Route("/card", name="card")
     */
    public function index(CardModelRepository $repo)
    {

        $cards = $repo->findAll();

        return $this->render('card/index.html.twig', [
            'title' => 'DoG Listing des cartes',
            'mainNavCard' => true, 
            'cards'=> $cards,
        ]);
    }
    
 
    /**
     * @Route("/card/{id}/destroy", name="card_destroy")
     */
    public function destroy(Card $card, ObjectManager $manager)
    {
        $manager->remove($card);
        $manager->flush();
        $this->addFlash('success', 'Suppression réussi de la carte');
        return $this->redirectToRoute( 'card', [
            'mainNavCard' => true,
        ]);

    }




    /**
     * @Route ("/card/new", name="card_create")
     * @Route ("/card/{id}/edit", name="card_edit")
     */
    public function form(Card $card = null, Request $request, ObjectManager $manager, TypeOfCardRepository $repo ) {

        if (!$card) {
            $card = new card();
        } 

        $form = $this->createForm(cardType::class, $card);
        
        // transmission des données 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {    
            // Gestion du fichier pour dos de carte ? 
            if ($card->getBackgroundCard()) {
                $fileBack = $card->getBackgroundCard();
                $fileName = $this->getName().'.'.$fileBack->guessExtension(); 
                try{
                    $fileBack->move(
                        $this->getParameter('url_backgroundCard'),
                        $fileName
                    );
                }catch(FileException $e){
                    // Handle exception ...
                }
   
                $card->setBackgroundCard($fileName);
            } else { 
                $card->setBackgroundCard(SELF::URL_BACK);
            }
            

            // Gestion du fichier pour image Face  
            
         
            try{
                // path dans le services.yaml
                if ($card->getHeroModel()->getId() == SELF::CINEMA ) {
                    $fullUrl = 'url_picture_cinema';
                    $urlName = SELF::URL_CINEMA; 
                } else {
                    $fullUrl = 'url_picture_cuisine';
                    $urlName = SELF::URL_CUISINE; 
                }
                // nommer le nom du fichiers sans les espaces et en minuscules
                $nameCard = strtolower(str_replace(' ','_',$card->getName()));
                $fileNamePicture = $urlName.'/'.$nameCard.'.png'; 
                $filePicture = new UploadedFile($card->getPicture(), $fileNamePicture) ;
                $filePicture->move(
                    $this->getParameter($fullUrl),
                    $fileNamePicture
                );
                
            }catch(FileException $e){
                $this->addFlash('error', 'Un problème est survenur lors de l\'enregistrement de l\'illustration !');
            }
            
            $card->setPicture($fileNamePicture);

            // Ajout des types de cartes et gestion des copy_max
            foreach($card->getTypeOfCards() as $type){
                $card->addTypeOfCard($type);
                if($type->getId() != SELF::CARD_SPE ) {
                    $card->setCopyMax(SELF::COPYMAX_CARD);
                    break;
                }else {
                    $card->setCopyMax(SELF::COPYMAX_CARD_SPE);
                }
            }
            // posibilité de mettre une valeur par défault dans la BDD
            $card->setDescription('');
            $card->setPosition(SELF::IN_DECK);
            

            $manager->persist($card);
            $manager->flush();


            $this->addFlash('success', 'Création réussi de la carte');

            return $this->redirectToRoute( 'card_show', [
                'title' => 'DoG',
                'mainNavCard' => true,
                'id' => $card->getId()
                ] );
        }

        // return de la view 
        return $this->render('/card/create.html.twig', [
            'title' => 'DoG create card',
            'mainNavCard' => true,
            'formCard' => $form->createView(),
            'editMode' => $card->getId() !== null,
        ]);

    }

    /**
     * @Route("/card/{id}", name="card_show")
     */
    public function show(Card $card)
    {
        return $this->render('card/show.html.twig', [
            'title' => 'DoG',
            'mainNavCard' => true,
            'card' => $card,
        ]);
    }

}
