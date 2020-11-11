<?php

namespace App\Controller;


use App\Entity\Departement;
use App\Form\DepartementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    /**
     * @Route("/parametres/departement", name="departement")
     */
    public function createDepartement(Departement $dapartement = null,Request $request, EntityManagerInterface $manager)
    {
        if(!$dapartement){
            $dapartement = new Departement();
        }

        $form = $this->createForm(DepartementType::class, $dapartement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($dapartement);
            $manager->flush();
        }

        $viewDepartement = $this->getDoctrine()->getRepository(Departement::class);
        $departements = $viewDepartement->findAll();

        return $this->render('departement/departement.html.twig', [
            'controller_name' => 'DepartementController',
            'form'=>$form->createView(),
            'departements'=>$departements
        ]);
    }
}
