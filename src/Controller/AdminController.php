<?php

namespace App\Controller;


use App\Entity\Status;
use App\Form\StatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/parametres/departement", name="departement")
     */
    public function index()
    {
        return $this->render('admin/fonction.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/config/configuration", name="config_fonction")
     */
    public function settingPersonal(Status $status = null, Request $request, EntityManagerInterface $manager)
    {

        if(!$status){
            $status = new Status();
        }

        $formStatus = $this->createForm(StatusType::class, $status);
        $formStatus->handleRequest($request);

        if($formStatus->isSubmitted() && $formStatus->isValid())
        {
            $manager->persist($status);
            $manager->flush();
        }

        $stat = $this->getDoctrine()->getRepository(Status::class);
        $status = $stat->findAll();

        return $this->render('configuration/config.html.twig',
                [
                    'formStatus'=>$formStatus->createView(),
                    'status'=>$status
                    ]);
        }
}