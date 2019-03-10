<?php
namespace App\Controller;


use App\Entity\Entity\Email;
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

        //TODO: Obsługa tagów

        $email = $_POST['email'];

        $entityManager = $this->getDoctrine()->getManager();

        $emailAdress = new Email();
        $emailAdress->setEmailAddress($email);


        $entityManager->persist($emailAdress);
        $entityManager->flush();


        return $this->render( 'addNewEmail.html.twig');

        }

}

