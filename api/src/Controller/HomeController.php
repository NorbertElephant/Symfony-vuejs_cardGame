<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\httpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(UserRepository $repo)
    {

        $users = $repo->findAll();

        return $this->render('user/index.html.twig', [
            'title' => 'DoG Listing des users',
            'users' => $users,
        ]);

    // }else {
        // var_dump($app);

        // if ($app)  {

        //     return $this->render('user/show.html.twig', [
                // 'user' => $user,
        //     ]);
        // }else {

        //     return $this->render('user/index.html.twig', [
        //         // 'users' => $users,
        //     ]);
        // }

    }
}
