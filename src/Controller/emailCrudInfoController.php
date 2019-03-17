<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Email_has_tag;
use App\Entity\Entity\Mailing;
use App\Entity\Entity\Mailing_has_tag;
use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class emailCrudInfoController extends Controller
{
    /**
     * @Route("/addEmail/info/{emailId}", name="EmailCrudInfo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $emailId
     */
    public function mainAction($emailId, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();
        $email = $entityManager->getRepository(Email::class)->findOneBy(array('emailId'=>$emailId));

        $emailTagId = $entityManager->getRepository(Email_has_tag::class)->findBy(array('emailEmailId'=>$emailId));

        if(sizeof($emailTagId) > 1){
        $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagId'=>$emailTagId[1]->getTagTagId()));
        }else{
            $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagId'=>$emailTagId[0]->getTagTagId()));
        }

        $tagName = $tag->getTagName();

        $paginator = $this->get('knp_paginator');





        return $this->render('emailCrudInfo.html.twig', array(
            'email' => $email,
            'tag' => $tagName
        ));
    }



}

