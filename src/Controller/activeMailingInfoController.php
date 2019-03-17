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


class activeMailingInfoController extends Controller
{
    /**
     * @Route("/listMailing/info/{mailingId}", name="ListMailingInfo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $mailingId
     */
    public function mainAction($mailingId, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();
        $mailing = $entityManager->getRepository(Mailing::class)->findOneBy(array('mailingId'=>$mailingId));

        $mailingTagId = $entityManager->getRepository(Mailing_has_tag::class)->findBy(array('mailingMailingId'=>$mailingId));

        if(sizeof($mailingTagId) > 1){
        $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagId'=>$mailingTagId[1]->getTagTagId()));
        }else{
            $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagId'=>$mailingTagId[0]->getTagTagId()));
        }

        $tagName = $tag->getTagName();

        $paginator = $this->get('knp_paginator');





        return $this->render('activeMailingInfo.html.twig', array(
            'mailing' => $mailing,
            'tag' => $tagName
        ));
    }



}

