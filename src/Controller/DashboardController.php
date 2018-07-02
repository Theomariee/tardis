<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\TypeCc;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $rTypeCc = $this->getDoctrine()->getRepository(TypeCc::Class);
        $toTypeCc = $rTypeCc->findAll();

        dump($toTypeCc);

        return $this->render('dashboard/index.html.twig', [
            'headTitle' => 'Dashboard',
        ]);
    }
}
