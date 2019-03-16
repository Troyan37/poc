<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;


class verifyEmailController2 extends Controller
{
    /**
     * @Route("/verifyEmail2", name="VerifyEmail2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');


        $email = $_POST['email'];
        

        try {
            $result = $SesClient->verifyEmailIdentity([
                'EmailAddress' => $email,
            ]);
            var_dump($result);
        } catch (AwsException $e) {

        }

        return $this->render( 'verifyEmail.html.twig');

        }

}

