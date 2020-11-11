<?php

namespace App\Controller;

use App\Entity\Fonction;
use App\Form\FonctionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FonctionController extends AbstractController
{
    /**
     * @Route("/parametre/fonction", name="fonction_create")
     * @Route("/parametre/fonction/edit/{id}") name="edit_fonction")
     */
    public function createFonction(Fonction $fonction = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$fonction){
            $fonction = new Fonction();
        }

        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($fonction);
            $manager->flush();
        }

        $fx = $this->getDoctrine()->getRepository(Fonction::class);
        $fonctions = $fx->findAll();

        return $this->render('fonction/fonction.html.twig', [
            'controller_name' => 'FonctionController',
            'formFonction'=>$form->createView(),
            'fonctions'=>$fonctions
        ]);
    }

//    /**
//     * @Route("/edit/parametre/fonction/{id}" name="edit_fonction")
//    */
//    public function editFonction(Fonction $fonction, Request $request, EntityManagerInterface $manager){
//        $form = $this->createForm(Fonction::class, $fonction);
//        $form->handleRequest($request);
//
//        if($form->isValid() && $form->isSubmitted()){
//            $manager->flush();
//        }
//        return $this->render('fonction/fonction-edit.html.twig',[
//            'formFonction'=>$form->createView(),
//            'form'=>$fonction
//        ]);
//    }
}
