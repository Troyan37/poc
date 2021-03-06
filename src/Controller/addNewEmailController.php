<?php
namespace App\Controller;


use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class addNewEmailController extends Controller
{
    /**
     * @Route("/addNewEmail", name="AddNewEmail")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $allTags = $entityManager->getRepository(Tag::class)->findAll();


        return $this->render( 'addNewEmail.html.twig' ,array(
            'tags' => $allTags));

        }

}

