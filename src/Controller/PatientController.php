<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
//    /**
//     * @Route("/", name="login")
//     */
//    public function index()
//    {
//        return $this->render('patient/login.html.twig', [
//            'controller_name' => 'PatientController',
//        ]);
//    }

    /**
     * @Route("/creer-fiche", name="creer_fiche")
     */
    public function createFiche(){
        return $this->render(
          'patient/creer-fiche.html.twig'
        );
    }
}
