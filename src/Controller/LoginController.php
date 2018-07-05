<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\AppUser;

class LoginController extends Controller
{
    /**
      * @Route("/login", name="login")
      */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $formLogin = $this->get('form.factory')
        ->createNamedBuilder(null)
        ->add('_username', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, ['label' => 'Adresse e-mail'])
        ->add('_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe'])
        ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Valider'])
        ->getForm();

        return $this->render('login/login.html.twig', [
            'headTitle' => 'Connexion',
            'formLogin' => $formLogin->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
