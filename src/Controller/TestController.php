<?php
namespace App\Controller;

use App\Entity\Entity\Email;
use App\Entity\Entity\Tag;

use App\Entity\Entity\Verified_email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends Controller
{
    /**
     * @Route("/test", name="Test")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $paginator  = $this->get('knp_paginator');

        //lista email i tag
        $allEmails = $entityManager->getRepository(Email::class)->findAll();
        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $allVerified = $entityManager->getRepository(Verified_email::class)->findAll();


        $emails = $paginator->paginate(
        // Doctrine Query, not results
            $allEmails,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );


        //dodanie email
        $email = new Email();
        $email->setEmailAddress('');

        $form = $this->createFormBuilder($email)
            ->add('emailAddress', TextType::class,  array('label' => 'Adres email'))
            ->add('save', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();

        $form->handleRequest($request);


        //email
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager->persist($task);
            $entityManager->flush();
            $email->setEmailAddress('');

        }



        return $this->render( 'main.html.twig', array(
            'tags' => $allTags,
            'emails' => $emails,
            'fromEmails' =>  $allVerified,
            'form' => $form->createView(),
        ));


        //return $this->render('main.html.twig');
    }

}
