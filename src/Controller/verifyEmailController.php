<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;


class verifyEmailController extends Controller
{
    /**
     * @Route("/verifyEmail", name="VerifyEmail")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render( 'verifyEmail.html.twig');

        }

}

