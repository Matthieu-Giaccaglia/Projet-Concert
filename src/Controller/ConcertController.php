<?php

namespace App\Controller;

use App\Entity\ConcertConcert;
use App\Form\ConcertConcertType;
use App\Repository\ConcertConcertRepository;
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
     * Show home page.
     *
     * @param ManagerRegistry $managerRegistry
     * @return Response
     *
     * @Route("", name="concert_home")
     */
    public function homeAction(ManagerRegistry  $managerRegistry): Response
    {
        $concerts = $managerRegistry->getRepository(ConcertConcert::class)->getNextConcert();

        return $this->render('concert/home.html.twig',[
            'concerts' => $concerts
        ]);
    }

    /**
     * Show list of concerts for regular user.
     *
     * @param ConcertConcertRepository $concertRepository
     * @return Response
     *
     * @Route("/concert", name="concert_index")
     */
    public function indexAction(ConcertConcertRepository $concertRepository): Response
    {
        return $this->render('concert/index.html.twig', [
            'concerts' => $concertRepository->getOrderByDateDESC()
        ]);
    }


    /**
     * Show list of concerts for admin.
     *
     * @param ConcertConcertRepository $concertRepository
     * @return Response
     *
     * @Route("/concert/list", name="concert_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function listAction(ConcertConcertRepository $concertRepository): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $concertRepository->findAll()
        ]);
    }

    /**
     * Show information of a concert.
     *
     * @param ConcertConcert $concert
     * @return Response
     *
     * @Route("/concert/{id}", name="concert_show", requirements={"id"="\d+"})
     */
    public function showAction(ConcertConcert $concert): Response
    {

        return $this->render('concert/show.html.twig', [
            'concert' => $concert
        ]);
    }

    /**
     * To edit a concert.
     *
     * @param Request $request
     * @param ConcertConcert $concertConcert
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     * @Route("/concert/{id}/edit", name="concert_edit", requirements={"id"="\d+"}, methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, ConcertConcert $concertConcert, EntityManagerInterface $entityManager): Response
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
     * To create a new concert.
     *
     * @param Request $request
     * @return Response
     *
     * @Route("/concert/new", name="concert_new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function newAction(Request $request): Response
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
     * To delete a group.
     *
     * @param Request $request
     * @param ConcertConcert $concertConcert
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     * @Route("/concert/{id}/delete", name="concert_delete", requirements={"id"="\d+"}, methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Request $request, ConcertConcert $concertConcert, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concertConcert->getId(), $request->request->get('_token'))) {
            $entityManager->remove($concertConcert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('concert_list', [], Response::HTTP_SEE_OTHER);
    }
}
