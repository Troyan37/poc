<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class addNewTagController extends Controller
{
    /**
     * @Route("/addNewTag", name="AddNewTag")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render( 'addNewTag.html.twig');

        }

}

