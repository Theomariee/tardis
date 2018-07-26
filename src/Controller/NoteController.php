<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/note", name="note")
 */
class NoteController extends Controller
{
    /**
     * @Route("/listeNotes", name="_listeNotes")
     */
    public function listeNotes(UserInterface $user)
    {
        $em = $this->getDoctrine()->getManager();
        $rEtudiant = $em->getRepository('App:Etudiant');
        $rNote = $em->getRepository('App:Note');

        $numeroEtudiant = $user->getEtudiant()->getNumeroEtudiant();
        $oEtudiant = $rEtudiant->findOneByNumeroEtudiant($numeroEtudiant);

        $toNote = $rNote->findByEtudiant($oEtudiant, array('datePublication' => 'ASC'));

        $tResult = array();
        foreach ($toNote as $oNote) {
            array_push($tResult, $oNote->getNote());
        }
        dump($tResult);

        return $this->render('note/listeNotes.html.twig', [
            'headTitle' => 'Mes notes',
            'oEtudiant' => $oEtudiant,
            'tNote' => json_encode($tResult),
        ]);
    }

    /**
     * @Route("/listeJson", name="_listeJson")
     */
    public function listeJsonAction(Request $request, UserInterface $user, NoteRepository $rNote, EtudiantRepository $rEtudiant)
    {
        $numeroEtudiant = $user->getEtudiant()->getNumeroEtudiant();
        $oEtudiant = $rEtudiant->findOneByNumeroEtudiant($numeroEtudiant);
        $toNote = $rNote->findByEtudiant($oEtudiant);

        $tResult = array();
        if(!$toNote){
            $tResult = array('data'=>'');
        }
        foreach ($toNote as $oNote) {
            $t = array();
            $t['DT_RowId'] = $oNote->getId();
            $t['matiere'] = $oNote->getMatiere()->getCode();
            $t['datePublication'] = $oNote->getDatePublication()->format('d/m/Y');
            $t['typeCc'] = $oNote->getTypeCc()->getLibelle();
            $t['note'] = $oNote->getNote();
            $t['meilleureNote'] = $rNote->getMeilleureNote($oNote->getMatiere()->getId(), $oNote->getTypeCc()->getId());
            $t['noteMoyenne'] = $rNote->getNoteMoyenne($oNote->getMatiere()->getId(), $oNote->getTypeCc()->getId());

            $tResult['data'][] = $t;
        }

        $response = new JsonResponse($tResult);
        return $response;
    }
}
