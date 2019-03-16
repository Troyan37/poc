<?php
namespace App\Controller;

use App\Entity\Entity\Email;
use App\Entity\Entity\Tag;

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
       // $allTags = $entityManager->getRepository(Tag::class)->findAll();


        $emails = $paginator->paginate(
        // Doctrine Query, not results
            $allEmails,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );



        //dodanie email
        $email = new Email();
        $email->setEmailAddress('');

        $form = $this->createFormBuilder($email)
            ->add('emailAddress', TextType::class,  array('label' => 'Adres email'))
            ->add('save', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();

        $form->handleRequest($request);

        //tag
       /* $tag = new Tag();
        $tag->setTagName('');

        $form2 = $this->createFormBuilder($tag)
            ->add('tagName', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();

        $form2->handleRequest($request);*/

        //email
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager->persist($task);
            $entityManager->flush();
            $email->setEmailAddress('');

        }

        //tag
       /* if ($form2->isSubmitted() && $form2->isValid()) {
            $task = $form2->getData();

            $entityManager->persist($task);
            $entityManager->flush();
            $tag->setTagName('');

        }*/


        return $this->render( 'main.html.twig', array(
            //'tags' => $allTags,
            'emails' => $emails,
            'form' => $form->createView(),
            //'form2' => $form2->createView()
        ));


        //return $this->render('main.html.twig');
    }

}
