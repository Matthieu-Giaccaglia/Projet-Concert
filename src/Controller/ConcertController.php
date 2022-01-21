<?php

namespace App\Controller;

use App\Entity\ConcertConcert;
use App\Form\ConcertConcertType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{


    /**
     * @param ManagerRegistry $managerRegistry
     * @return Response
     *
     * @Route("/", name="concert_index")
     */
    public function indexAction(ManagerRegistry  $managerRegistry): Response
    {
        $concerts = $managerRegistry->getRepository(ConcertConcert::class)->getNextConcert();

        return $this->render('concert/index.html.twig',[
            'concerts' => $concerts
        ]);
    }


    /**
     * @Route("/concert/list", name="concert_list")
     */
    public function listAction(ManagerRegistry $managerRegistry): Response
    {

        $concerts = $managerRegistry->getRepository(ConcertConcert::class)->findAll();

        return $this->render('concert/list.html.twig', [
            'concerts' => $concerts
        ]);
    }

    /**
     * @Route("/concert/edit/{id}", name="concert_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, ConcertConcert $concertConcert, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConcertConcertType::class, $concertConcert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('concert_list');
        }

        return $this->renderForm('concert/edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     *
     * @param Request $request
     * @return Response
     * @Route("/concert/create", name="concert_create")
     */
    public function createConcert(Request $request): Response
    {
        $show = new ConcertConcert();

        $form = $this->createForm(ConcertConcertType::class, $show);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($show);
            $entityManager->flush();

            return $this->redirectToRoute('concert_list');
        }

        return $this->render('concert/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/concert/delete/{id}", name="concert_delete")
     */
    public function delete(Request $request, ConcertConcert $concert): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('concert_list');
    }
}
