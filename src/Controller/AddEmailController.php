<?php
namespace App\Controller;


use App\Entity\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AddEmailController extends AbstractController
{
    /**
     * @Route("/addEmail", name="AddEmail")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $email = new Email();
        $email->setEmailAddress("testSymf4@interia.pl");

        $entityManager->persist($email);

        $entityManager->flush();

        return $this->render('main.html.twig');
    }

}

