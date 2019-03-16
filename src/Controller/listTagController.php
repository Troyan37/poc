<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class listTagController extends Controller
{
    /**
     * @Route("/listTag", name="ListTag")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();


        $paginator  = $this->get('knp_paginator');

        $allTags = $entityManager->getRepository(Tag::class)->findAll();


        $tags = $paginator->paginate(
        // Doctrine Query, not results
            $allTags,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );



        return $this->render( 'tagCrud.html.twig', array(
            'tags' => $tags
        ));

        }




}

