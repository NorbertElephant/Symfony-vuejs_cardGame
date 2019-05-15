<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\httpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_main")
     * @Route("/home", name="home")
     */
    public function index(ObjectManager $manager)
    {

        // var_dump($this->get('security.token_storage')->getToken()->getUser()  ) ; // Avoir l'user Connecté 
        if($this->get('security.token_storage')->getToken()->getUser() !== 'anon.' ) {

    
           
            return $this->redirectToRoute('user');


        } else {
            
            return $this->redirectToRoute('security_login');

        }
    

    }
}
