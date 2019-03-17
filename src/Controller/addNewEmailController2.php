<?php

namespace App\Controller;


use App\Entity\Entity\Email;
use App\Entity\Entity\Email_has_tag;
use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class addNewEmailController2 extends Controller
{
    /**
     * @Route("/addNewEmail2", name="AddNewEmail2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $emailAdress = $_POST['email'];
        $chosenTag = $_POST['tag'];

        $entityManager = $this->getDoctrine()->getManager();
        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $tagALL = $entityManager->getRepository(Tag::class)->findOneBy(array('tagName' => 'ALL'));

        $email = new Email();
        $email->setEmailAddress($emailAdress);


        if ($entityManager->getRepository(Email::class)->findOneBy(array('emailAddress' => $emailAdress)) == null) {

            //dodaj adres
            $entityManager->persist($email);
            $entityManager->flush();

            $email = $entityManager->getRepository(Email::class)->findOneBy(array('emailAddress' => $emailAdress));

            //dodaj tag ALL
            $emailHasTag = new Email_has_tag();
            $emailHasTag->setEmailEmailId($email->getEmailId());
            $emailHasTag->setTagTagId($tagALL->getTagId());

            $entityManager->persist($emailHasTag);
            $entityManager->flush();

            //dodaj wybrany tag
            if ($chosenTag != 'ALL') {

                $emailHasTag2 = new Email_has_tag();
                $emailHasTag2->setEmailEmailId($email->getEmailId());
                $tag = $entityManager->getRepository(Tag::class)->findOneBy(array('tagName' => $chosenTag));
                $emailHasTag2->setTagTagId($tag->getTagId());
                $entityManager->persist($emailHasTag2);
            }

            $entityManager->flush();

        } else {
            echo "Taki adres już istnieje!";
        }


        return $this->render('addNewEmail.html.twig', array(
            'tags' => $allTags));

    }

}

