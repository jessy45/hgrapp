<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Form\DemandeCongeType;
use App\Repository\DemandeCongeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande/conge")
 */
class DemandeCongeController extends AbstractController
{
//    /**
//     * @Route("/", name="demande_conge_index")
//     */
//    public function index(DemandeCongeRepository $demandeCongeRepository)
//    {
//        $demande = $demandeCongeRepository->findAll();
//        $conge = [];
//        foreach($demande as $demandes){
//            $conge[] = [
//                'id'=>$demandes->getId(),
//                'start'=>$demandes->getDateDebut()->format('Y-m-d'),
//                'end'=>$demandes->getDateFin()->format('Y-m-d'),
//                'title'=>'Congé maladie',
//                'backgroundColor'=>'#f56954',
//                'borderColor'=> '#f56954'
//            ];
//        }
//        $donnees = json_encode($conge);
//        return $this->render('demande_conge/index.html.twig', ['donnees'=>$donnees]);
//    }

    /**
     * @Route("/", name="demande_conge_index")
     */
    public function new(Request $request, DemandeCongeRepository $demandeCongeRepository): Response
    {
        $demande = $demandeCongeRepository->findAll();
        $conge = [];
        foreach($demande as $demandes){
            $conge[] = [
                'id'=>$demandes->getId(),
                'start'=>$demandes->getDateDebut()->format('Y-m-d'),
                'end'=>$demandes->getDateFin()->format('Y-m-d'),
                'title'=>'Congé maladie',
                'backgroundColor'=>'#f56954',
                'borderColor'=> '#f56954'
            ];
        }
        $donnees = json_encode($conge);
        $demandeConge = new DemandeConge();
        $form = $this->createForm(DemandeCongeType::class, $demandeConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeConge);
            $entityManager->flush();

            return $this->redirectToRoute('demande_conge_index');
        }

        return $this->render('demande_conge/index.html.twig', [
            'demande_conge' => $demandeConge,
            'donnees'=>$donnees,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_conge_show", methods={"GET"})
     */
    public function show(DemandeConge $demandeConge): Response
    {
        return $this->render('demande_conge/show.html.twig', [
            'demande_conge' => $demandeConge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_conge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeConge $demandeConge): Response
    {
        $form = $this->createForm(DemandeCongeType::class, $demandeConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_conge_index');
        }

        return $this->render('demande_conge/edit.html.twig', [
            'demande_conge' => $demandeConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_conge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DemandeConge $demandeConge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeConge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeConge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_conge_index');
    }
}
