<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function dashboard()
    {
        return $this->render('admin/dashboard.html.twig', [
            'headTitle' => 'Admin',
        ]);
    }
}
