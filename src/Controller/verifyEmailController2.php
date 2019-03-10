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

        $SesClient = new SesClient([
            'credentials' => [
                'key'    => 'AKIAIUSP5O7BGP6GW6YA',
                'secret' => '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',
            ],
            'version' => 'latest',
            'region' => 'eu-west-1'
        ]);

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

