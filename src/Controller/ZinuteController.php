<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZinuteController extends AbstractController
{
    /**
     * @Route("/zinute", name="zinute")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $zinute = new Zinute();
        $zinute->setTekstas('Test');
        $zinute->setData(date('Y-m-d H:i:s'));
        $entityManager->persist($zinute);
        $entityManager->flush();

        return new Response('Zinute issaugota su ID '.$entityManager->getId());
    }
}
