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
     public function login(Request $request,  AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'headTitle' => 'Connexion',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }











    // /**
    //  * @Route("/login", name="login")
    //  */
    // public function login(Request $request)
    // {
    //     dump($request->getSession());
    //     $username = $request->get('_username');
    //     $last_username = $username;
    //     $error = null;

    //     if(isset($username)) {
    //         $repositoryEtudiant = $this->getDoctrine()->getRepository(Etudiant::class);
    //         $oEtudiant = $repositoryEtudiant->findByNumeroEtudiant($username);

    //         if(!$oEtudiant) {
    //             $error = "Aucun étudiant n'est connu sous ce numéro.";
    //         }

    //         else {
    //             $session = $request->getSession();
    //             $session->set('numeroEtudiant', $username);
    //             return $this->redirectToRoute('dashboard');
    //         }
    //     }

    //     else {
    //         $error = "Veuillez saisir un numéro d'étudiant.";
    //     }

    //     return $this->render('login/login.html.twig', [
    //         'headTitle' => 'Connexion',
    //         'last_username' => $last_username,
    //         'error'         => $error,
    //     ]);
    // }

    // /**
    //  * @Route("/logout", name="logout")
    //  */
    // public function logout(Request $request)
    // {
    //     $session = $request->getSession();
    //     $session->clear();

    //     return $this->redirectToRoute('login');
    // }
}
