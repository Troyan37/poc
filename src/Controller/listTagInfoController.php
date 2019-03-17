<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Email_has_tag;
use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class listTagInfoController extends Controller
{
    /**
     * @Route("/listTag/info/{tagId}", name="ListTagInfo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $tagId
     */
    public function mainAction($tagId, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();

        $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagId'=>$tagId));
        $tagName = $tag->getTagName();

        $paginator = $this->get('knp_paginator');

        $allEmailHasTag = $entityManager->getRepository(Email_has_tag::class)->findBy(array('tagTagId'=>$tagId));
        $allEmailIds = [];
        $i = 0;
        foreach ($allEmailHasTag as $EmailHasTag) {
            $allEmailIds[$i] = $EmailHasTag->getEmailEmailId();
            $i = $i+1;
        }

        $allEmails = $entityManager->getRepository(Email::class)->findBy(array('emailId' => $allEmailIds));


        $emails = $paginator->paginate(
        // Doctrine Query, not results
            $allEmails,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );


        return $this->render('tagCrudInfo.html.twig', array(
            'emails' => $emails,
            'tag' => $tagName
        ));
    }



}

