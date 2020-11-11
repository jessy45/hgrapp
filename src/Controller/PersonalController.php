<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonalController extends AbstractController
{
//    /**
//     * @Route("/personal", name="personal")
//     */
//    public function index()
//    {
//        return $this->render('personal/fonction.html.twig', [
//            'controller_name' => 'PersonalController',
//        ]);
//    }

    /**
     * @Route("/creer/personnel", name="create_personal")
    */
    public function createPersonal(Personnel $personnel = null, Request $request, EntityManagerInterface $manager){
        if(!$personnel){
            $personnel = new Personnel();
        }
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($personnel);
            $manager->flush();
        }

        return $this->render('personal/create.html.twig',
        [
            'formPersonnel'=>$form->createView(),
            ]
        );
    }

    /**
     * @Route("view/personal", name="view_personal")
    */
    public function viewPersonal(){
        $formView = $this->getDoctrine()->getRepository(Personnel::class);
        $personnels = $formView->findAll();

        return $this->render('personal/view-personal', ['personnels'=>$personnels]);
    }

    /**
     * @Route("view/personal/detail/{id}", name="detail_personal")
     */
    public function viewDetail($id){
        $formView = $this->getDoctrine()->getRepository(Personnel::class);
        $personnels = $formView->find($id);

        return $this->render('personal/details-personal.html.twig', [
            'personnels'=>$personnels
        ]);
    }

    /**
     * @Route("/edit/personal/{id}", name="edit_personal")
    */
    public function editPersonal(Personnel $personnel, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->flush();
            return $this->redirectToRoute('view_personal');
        }
        return $this->render('/personal/edit-personal.html.twig', [
            'personnel'=>$personnel,
            'form'=>$form->createView()
        ]);
    }
}