<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Email_has_tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AddEmailController extends Controller
{
    /**
     * @Route("/addEmail", name="AddEmail")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();


        $paginator  = $this->get('knp_paginator');

        $allEmails = $entityManager->getRepository(Email::class)->findAll();


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
            ->add('emailAddress', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Dodaj'))
            ->getForm();

        $form->handleRequest($request);


        //email
/*        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager->persist($task);
            $entityManager->flush();
            $email->setEmailAddress('');

        }
*/

        return $this->render( 'emailCrud.html.twig', array(
            'emails' => $emails,
            'form' => $form->createView(),
        ));

        }


    /**
     * @Route("/addEmail/delete/{emailId}")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param $emailId
     */
        public function deleteEmail($emailId, Request $request){

            $this->denyAccessUnlessGranted('ROLE_USER');

            $entityManager = $this->getDoctrine()->getManager();

            while($entityManager->getRepository(Email_has_tag::class)->findOneBy( array('emailEmailId' => $emailId)) != null){
            $tagId = $entityManager->getRepository(Email_has_tag::class)->findOneBy( array('emailEmailId' => $emailId));
            $entityManager->remove($tagId);
            $entityManager->flush();
            }
            $email = $entityManager->getRepository(Email::class)->find($emailId);

            $entityManager->remove($email);
            $entityManager->flush();

            return AddEmailController::mainAction($request);

        }

}

