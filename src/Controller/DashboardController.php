<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\TypeCc;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(Request $request, UserInterface $user)
    {
        dump($user->getEtudiant()->getNumeroEtudiant());

        return $this->render('dashboard/dashboard.html.twig', [
            'headTitle' => 'Dashboard',
        ]);
    }
}
