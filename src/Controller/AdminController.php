<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function dashboard(Request $request, UserInterface $user)
    {
        $em = $this->getDoctrine()->getManager();
        $rEtudiant = $em->getRepository('App:Etudiant');
        $numeroEtudiant = $user->getEtudiant()->getNumeroEtudiant();
        $oEtudiant = $rEtudiant->findOneByNumeroEtudiant($numeroEtudiant);

        return $this->render('admin/dashboard.html.twig', [
            'headTitle' => 'Admin',
            'oEtudiant' => $oEtudiant
        ]);
    }
}
