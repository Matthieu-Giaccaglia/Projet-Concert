<?php

namespace App\Controller;

use App\Entity\ConcertArtist;
use App\Form\ConcertArtistType;
use App\Repository\ConcertArtistRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ConcertArtistRepository $concertArtistRepository): Response
    {
        return $this->render('artist/index.html.twig', [
            'concert_artists' => $concertArtistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artist_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $concertArtist = new ConcertArtist();
        $form = $this->createForm(ConcertArtistType::class, $concertArtist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file')->getData();

            $fileName = strtolower($concertArtist->getName());


            $fileName = $fileUploader->upload($file,'img/artists', $fileName);

            if(!$fileName) {
                return $this->renderForm('artist/new.html.twig', [
                    'concert_artist' => $concertArtist,
                    'form' => $form,
                ]);
            }

            $concertArtist->setImgName($fileName);

            $entityManager->persist($concertArtist);
            $entityManager->flush();

            return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist/new.html.twig', [
            'concert_artist' => $concertArtist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artist_show", methods={"GET"})
     */
    public function show(ConcertArtist $concertArtist): Response
    {
        return $this->render('artist/show.html.twig', [
            'concert_artist' => $concertArtist,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="artist_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, ConcertArtist $concertArtist, EntityManagerInterface $entityManager): Response
    {

        foreach ($concertArtist->getConcertGroups() as $concertGroup) {
            echo $concertGroup;
        }

        $form = $this->createForm(ConcertArtistType::class, $concertArtist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist/edit.html.twig', [
            'concert_artist' => $concertArtist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artist_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, ConcertArtist $concertArtist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concertArtist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($concertArtist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
