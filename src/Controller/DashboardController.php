<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\TypeCc;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(Request $request)
    {
        $rTypeCc = $this->getDoctrine()->getRepository(TypeCc::Class);
        $toTypeCc = $rTypeCc->findAll();

        dump($request->getSession()->get('numeroEtudiant'));

        return $this->render('dashboard/dashboard.html.twig', [
            'headTitle' => 'Dashboard',
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
