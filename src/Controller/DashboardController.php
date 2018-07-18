<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(Request $request, UserInterface $user)
    {
        $this->init($user);
        $em = $this->getDoctrine()->getEntityManager();
        $rEtudiant = $em->getRepository('App:Etudiant');
        $rNote = $em->getRepository('App:Note');
        $rMatiere = $em->getRepository('App:Matiere');
        $rSemestre = $em->getRepository('App:Semestre');
        $rEvenement = $em->getRepository('App:Evenement');
        $rEtudiantFiliere = $em->getRepository('App:EtudiantFiliere');

        $numeroEtudiant = $user->getEtudiant()->getNumeroEtudiant();
        $oEtudiant = $rEtudiant->findOneByNumeroEtudiant($numeroEtudiant);

        $oSemestreActuel = $rSemestre->getSemestreActuel();

        $toDernieresNotesEtudiant = [];
        $oNoteMax = NULL;
        $oNoteMin = NULL;
        if($oSemestreActuel) {
            //Dernières notes de l'étudiant appartenant au semestre actuel (càd les notes appartenant à une matière de ce semestre)
            $toDernieresNotesEtudiant = $rNote->findBy(array('matiere' => $rMatiere->findBySemestre($oSemestreActuel), 'etudiant' => $oEtudiant), array('datePublication' => 'DESC') );
            $oNoteMax = $rNote->findOneBy(array('matiere' => $rMatiere->findBySemestre($oSemestreActuel), 'etudiant' => $oEtudiant), array('note' => 'DESC') );
            $oNoteMin = $rNote->findOneBy(array('matiere' => $rMatiere->findBySemestre($oSemestreActuel), 'etudiant' => $oEtudiant), array('note' => 'ASC') );
        }

        $oEtudiantFiliere = $rEtudiantFiliere->getFiliereActuelle($oEtudiant->getId());
        $oFiliere = $oEtudiantFiliere->getFiliere();
        if($oFiliere) {
            $tProchainsEvenements = $rEvenement->getEvenementsFiliere($oFiliere->getId());
            $toProchainsEvenements = $rEvenement->findById($tProchainsEvenements);
        }

        return $this->render('dashboard/dashboard.html.twig', [
            'headTitle' => 'Dashboard',
            'oUser' => $user,
            'oEtudiant' => $oEtudiant,
            'toDernieresNotesEtudiant' => $toDernieresNotesEtudiant,
            'oNoteMax' => $oNoteMax,
            'oNoteMin' => $oNoteMin,
            'toProchainsEvenements' => $toProchainsEvenements
        ]);
    }

    private function init(UserInterface $user)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $rEtudiant = $em->getRepository('App:Etudiant');
        $rMatiere = $em->getRepository('App:Matiere');
        $rFiliere = $em->getRepository('App:Filiere');

        $numeroEtudiant = $user->getEtudiant()->getNumeroEtudiant();
        $oEtudiant = $rEtudiant->findOneByNumeroEtudiant($numeroEtudiant);
        $oMatiere = $rMatiere->find(1);
        $oFiliere = $rFiliere->find(1);
        $oFiliere->addMatiere($oMatiere);
        $oMatiere = $rMatiere->find(2);
        $oFiliere->addMatiere($oMatiere);
        $em->persist($oFiliere);
        $em->flush();
    }
}
