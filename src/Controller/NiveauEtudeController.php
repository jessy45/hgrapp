<?php

namespace App\Controller;

use App\Entity\NiveauEtude;
use App\Form\NiveauEtudeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NiveauEtudeController extends AbstractController
{
    /**
     * @Route("parametre/niveau/etude/", name="niveau_etude")
     */
    public function createEtude(NiveauEtude $niveauEtude = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$niveauEtude){
            $niveauEtude = new NiveauEtude();
        }

        $form = $this->createForm(NiveauEtudeType::class, $niveauEtude);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($form);
            $manager->flush();
        }

        $viewEtude = $this->getDoctrine()->getRepository(NiveauEtude::class);
        $etudes = $viewEtude->findAll();
        return $this->render('niveau_etude/etude.html.twig', [
            'controller_name' => 'NiveauEtudeController',
            'form'=>$form->createView(),
            'etudes'=>$etudes
        ]);
    }
}
