<?php

namespace App\Controller;

use App\Entity\Grade;
use App\Form\GradeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GradeController extends AbstractController
{
    /**
     * @Route("parametre/grade", name="grade")
     */
    public function createGrade(Grade $grade = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$grade){
            $grade = new Grade();
        }

        $formgrade = $this->createForm(GradeType::class, $grade);
        $formgrade->handleRequest($request);
        if($formgrade->isSubmitted() && $formgrade->isValid())
        {
            $manager->persist($grade);
            $manager->flush();
        }
        $grad = $this->getDoctrine()->getRepository(Grade::class);
        $grades = $grad->findAll();
        return $this->render('grade/grade.html.twig', [
            'controller_name' => 'GradeController',
            'formGrade'=>$formgrade->createView(),
            'grades'=>$grades
        ]);
    }
}
