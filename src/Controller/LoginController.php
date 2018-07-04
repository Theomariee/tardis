<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\Etudiant;

class LoginController extends Controller
{
    /**
      * @Route("/login", name="login")
      */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'headTitle' => 'Connexion',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
      * @Route("/loginCheck", name="login_check")
      */
    public function loginCheck(Request $request, AuthenticationUtils $authenticationUtils)
    {
        return $this->redirectToRoute('dashboard');
    }
}
