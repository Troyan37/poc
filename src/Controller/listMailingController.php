<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Mailing;
use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class listMailingController extends Controller
{
    /**
     * @Route("/listMailing", name="ListMailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();


        $paginator  = $this->get('knp_paginator');

        $allMailings = $entityManager->getRepository(Mailing::class)->findBy(array('status' => array('S','A')));


        $mailings = $paginator->paginate(
        // Doctrine Query, not results
            $allMailings,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
        );



        return $this->render( 'mailingCrud.html.twig', array(
            'mailings' => $mailings
        ));

        }


    /**
     * @Route("/listMailing/cancel/{mailingId}")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param $mailingId
     */
    public function cancelEmail($mailingId, Request $request){


        $entityManager = $this->getDoctrine()->getManager();
        $mailing = $entityManager->getRepository(Mailing::class)->find($mailingId);

        $mailing->setStatus('C');

        $entityManager->flush();


        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();


        $paginator  = $this->get('knp_paginator');

        $allMailings = $entityManager->getRepository(Mailing::class)->findBy(array('status' => array('S','A')));


        $mailings = $paginator->paginate(
        // Doctrine Query, not results
            $allMailings,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
        );


        return $this->render( 'mailingCrud.html.twig', array(
            'mailings' => $mailings
        ));

    }


}

