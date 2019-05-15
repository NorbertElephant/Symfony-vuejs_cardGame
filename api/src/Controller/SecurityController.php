<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\RegistrationType;
use App\Entity\User;

use App\Repository\RankRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    Const Member = 4 ; 

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, RankRepository $repo) {

        $user = new User();
        $rank = $repo->find(Self::Member);

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $user->setConnect(false);
            $user->setValid(false);
            $user->setRank($rank);
            $user->setNumGamePlayed(0);
            $user->setNumGameWin(0);


            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form'=> $form->createView(),
        ]);
    }
     /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(ObjectManager $manager){

        $user =  $this->get('security.token_storage')->getToken()->getUser();

        $user->setConnect(false);

        $manager->persist($user);
        $manager->flush();
    }



}
