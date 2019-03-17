<?php
namespace App\Controller;


use App\Entity\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class addNewTagController2 extends Controller
{
    /**
     * @Route("/addNewTag2", name="AddNewTag2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $tagName = $_POST['tag'];

        $entityManager = $this->getDoctrine()->getManager();

        $tag = new Tag();
        $tag->setTagName($tagName);


        if($entityManager->getRepository(Tag::class)->findOneBy(array('tagName' => $tagName)) == null){

        $entityManager->persist($tag);
        $entityManager->flush();

        }else{
            echo "Taki tag już istnieje!";
        }

        return $this->render( 'addNewTag.html.twig');

        }

}

