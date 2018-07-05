<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\AppUser;
use App\Entity\Etudiant;
use App\Form\AppUserType;

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

    /**
     * @Route("/login/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $submit = $request->get('submit');
        
        if (isset($submit)) {
            $userMail = $submit['_username'];
            $password = $submit['_password'];
            $numEtudiant = $submit['_etudiant'];
            $activerNotifications = false;
            if(array_key_exists('_notifications', $submit)) $activerNotifications = $submit['_notifications'];

            $em = $this->getDoctrine()->getManager();
            $rEtudiant = $em->getRepository('App:Etudiant');

            $oAppUser = $em->getRepository('App:AppUser')->findOneBy(array('adresseMail' => $userMail));

            if ($oAppUser) { //Compte avec cet email existant
                $this->addFlash('danger', 'Utilisateur déjà existant.');
            }

            else {
                $oEtudiantUtilise = $rEtudiant->findOneBy(array('numeroEtudiant' => $numEtudiant));

                if(!$oEtudiantUtilise) { //Aucun etudiant connu avec ce numéro
                    $this->addFlash('danger', 'Aucun étudiant n\'est connu sous ce numéro.');
                }

                else {
                    $oAppUser = $em->getRepository('App:AppUser')->findOneBy(array('etudiant' => $oEtudiantUtilise->getId()));

                    if($oAppUser) { //AppUser déjà inscrit avec ce numéro
                        $this->addFlash('danger', 'Un utilisateur s\'est déjà inscrit avec ce numéro d\'étudiant.');
                    }

                    else { //Inscription valide
                        $oAppUser = new AppUser();

                        $encodedPassword = $passwordEncoder->encodePassword($oAppUser, $password);
                        $oAppUser->setAdresseMail($userMail);
                        $oAppUser->setPassword($encodedPassword);
                        $oAppUser->setEtudiant($oEtudiantUtilise);
                        $oAppUser->setActiverNotifications($activerNotifications);
                        $oAppUser->addRole('ROLE_USER');

                        $oEtudiantUtilise->setAppUser($oAppUser);

                        // save the User!
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($oAppUser);
                        $em->persist($oEtudiantUtilise);
                        $em->flush();

                        // ... do any other work - like sending them an email, etc
                        // maybe set a "flash" success message for the user
                        $this->addFlash('success', 'Votre compte à bien été enregistré.');
                        return $this->redirectToRoute('login');
                    }
                }
            }
        }

        return $this->render('login/register.html.twig', [
            'headTitle' => 'Inscription',
        ]);
    }
}
