<?php

namespace App\Controller;

use App\Entity\ConcertArtist;
use App\Form\ConcertArtistType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
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
     * @Route("", name="artist_index", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $artists = $doctrine->getRepository(ConcertArtist::class)->findAll();

        if(!$artists) {
            throw  $this->createNotFoundException('Aucun artiste trouvé');
        }


        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
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
            'artist' => $concertArtist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artist_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(ConcertArtist $concertArtist, Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {

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

            unlink('img/artists/' . $concertArtist->getImgName());
            $concertArtist->setImgName($fileName);


            $entityManager->flush();

            return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist/edit.html.twig', [
            'concert_artist' => $concertArtist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="artist_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, ConcertArtist $concertArtist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concertArtist->getId(), $request->request->get('_token'))) {
            unlink('/img/artists/' . $concertArtist->getImgName());
            $entityManager->remove($concertArtist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
