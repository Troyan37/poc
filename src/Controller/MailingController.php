<?php

namespace App\Controller;

use App\Entity\Entity\Mailing;
use App\Entity\Entity\Mailing_has_tag;
use App\Entity\Entity\Tag;

use App\Entity\Entity\Verified_email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailingController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function sendAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /**
         * @Assert\NotBlank
         */
        $topic = $_POST['name'];
        $content = $_POST['message'];
        $tagName = $_POST['tag'];
        $fromEmail = $_POST['fromEmail'];
        //$fromEmail = "troyan123@engineer.com";
        $status = 'N';


        //Stworz mailing na podstawie danych z formularza

        $entityManager = $this->getDoctrine()->getManager();
        $tagRepository = $this->getDoctrine()->getRepository(Tag::class);
        $mailingRepository = $this->getDoctrine()->getRepository(Mailing::class);
        $allVerified = $entityManager->getRepository(Verified_email::class)->findAll();

        $mailing = new Mailing();
        $mailing_tag = new Mailing_has_tag();
        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $tag = $tagRepository->findOneBy(array('tagName' => $tagName));
        $time = new \DateTime();

        if (!$tag) {
            throw $this->createNotFoundException(
                'No tag found'
            );
        }


        $mailing->setTopic($topic);
        $mailing->setContent($content);
        $mailing->setFromEmail($fromEmail);
        $mailing->setStatus($status);
        $mailing->setTimeCreated($time);
        $mailing->setTimeSent(null);

        $entityManager->persist($mailing);

        $entityManager->flush();

        //Dodanie Mailing_tag

        $mailing = $mailingRepository->findOneBy(array('content' => $content, 'topic' => $topic, 'fromEmail' => $fromEmail, 'status' => 'N'));

        $mailingId = $mailing->getMailingId();
        $tagId = $tag->getTagId();


        $mailing_tag->setMailingMailingId($mailingId);
        $mailing_tag->setTagTagId($tagId);

        $entityManager->persist($mailing_tag);
        $entityManager->flush();


        //zmiana statusu z New na Awaiting
        $mailing->setStatus('A');
        $entityManager->flush();


        return $this->render('main.html.twig' ,array(
            'tags' => $allTags,
            'fromEmails' =>  $allVerified));
    }


}
