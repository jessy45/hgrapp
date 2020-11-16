<?php

namespace App\Controller;


use App\Entity\PersonalSearch;
use App\Entity\Personnel;
use App\Form\CongeType;
use App\Form\PersonalSearchType;
use App\Form\PersonnelType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
    */
    public function viewPersonal(Request $request,PaginatorInterface $paginator):Response
    {

        $search = new PersonalSearch();

        $formView = $this->getDoctrine()->getRepository(Personnel::class)->findVisibleQuery($search);
        $personnels = $paginator->paginate($formView,$request->query->getInt('page', 1), 3);
//        $personnels = $formView->findAll();

        $formSearch = $this->createForm(PersonalSearchType::class, $search);
        $formSearch->handleRequest($request);

        return $this->render('personal/view-personal',
            ['personnels'=>$personnels, 'form'=>$formSearch->createView()
            ]);
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

    /**
     * @Route("/personal/profile", name="profile")
    */
    public function viewProfil(){
        return $this->render("/profile/profile.html.twig");
    }

    /**
     * @Route("/personal/email", name="email")
    */
    public function index(Request $request, \Swift_Mailer $mailer){
        $form = $this->createForm(CongeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            // On crée le message
            $message = (new \Swift_Message('Nouveau contact'))
                // On attribue l'expéditeur
//                ->setFrom($contact['email'])
                // On attribue le destinataire
                ->setTo('jessymukund@gmail.com')
                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                        'personal/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
        }
        return $this->render('personal/index.html.twig',['contactForm' => $form->createView()]);
    }

    /**
     * @Route("/leave/personal", name="leave")
    */
    public function leaves(){
        return $this->render('personal/leaves.html.twig');
    }
}