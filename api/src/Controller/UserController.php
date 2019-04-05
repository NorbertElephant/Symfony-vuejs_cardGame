<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $repo)
    {
        $users = $repo->findAll();

        return $this->render('user/index.html.twig', [
            'title' => 'DoG Listing des users',
            'mainNavUser' => true,
            'users' => $users,
        ]);
    }

 
    /**
     * @Route("/user/{id}/destroy", name="user_destroy")
     */
    public function destroy(User $user, ObjectManager $manager)
    {
        $manager->remove($user);
        $manager->flush();
        $this->addFlash('success', 'Suppression réussi de l\'utilisateur');
        return $this->redirectToRoute( 'user', [
            'mainNavUser' => true,
        ]);
    }




    /**
     * @Route ("/user/new", name="user_create")
     * @Route ("/user/{id}/edit", name="user_edit")
     */
    public function form(User $user = null, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder ) {
        if (!$user) {
            $user = new User();
        } 

        $form = $this->createForm(UserType::class, $user);

        
        // transmission des données 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {
            if (!$user->getId()) {
                $user->setValid(false);
                $user->setConnect(false);
                $user->setNumGamePlayed(0);
                $user->setNumGameWin(0);
            }

            
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();


            $this->addFlash('success', 'Création réussi de l\'utilisateur');

            return $this->redirectToRoute( 'user_show', [
                'title' => 'DoG profil',
                'mainNavUser' => true,
                'id' => $user->getId()
                ] );
        }

        // return de la view 
        return $this->render('/user/create.html.twig', [
            'title' => 'DoG create profil',
            'mainNavUser' => true,
            'formUser' => $form->createView(),
            'editMode' => $user->getId() !== null,
        ]);

    }

    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function show(User $user)
    {
        return $this->render('user/show.html.twig', [
            'title' => 'DoG profil',
            'mainNavUser' => true,
            'user' => $user,
        ]);
    }

}
