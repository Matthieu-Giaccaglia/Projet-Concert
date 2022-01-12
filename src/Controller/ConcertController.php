<?php

namespace App\Controller;

use App\Entity\ConcertGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    /**
     * @Route("/", name="concert")
     */
    public function indexAction(): Response
    {
        return $this->render('concert/index.html.twig', [
            'controller_name' => 'Licence APIDAE',
        ]);
    }
}
