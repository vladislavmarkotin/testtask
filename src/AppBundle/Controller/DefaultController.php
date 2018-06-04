<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Album as Album;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$album = $this->getDoctrine()->getRepository(Album::NAME)->find(1);
        /*$album = new Album();
        $album->setAlbumName("gcfvigv");
        $album->setMusicianId(1);*/

        $entityManager = $this->getDoctrine()->getManager();
        $info = $entityManager->getRepository('AppBundle:'.Album::NAME)->find(1);
        //var_dump($info);

        if (!$info){
            throw $this->createNotFoundException("Error!");
        }
        //$entityManager->persist($album); //ошибка здесь!!!
        /*$entityManager->flush();*/

        $albums = array(
            "id" => $info->getId(),
            'album_name' => $info->getAlbumName(),
            'year' => $info->getYear()
        );
        // replace this example code with whatever you need
        return $this->render('default/test.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'info' => $albums,
        ));
    }
}
