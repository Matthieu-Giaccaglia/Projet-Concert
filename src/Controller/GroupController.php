<?php

namespace App\Controller;

use App\Entity\ConcertConcert;
use App\Entity\ConcertGroup;
use App\Form\ConcertGroupType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/group")
 */
class GroupController extends AbstractController
{
    /**
     * Affiche tous les groupes.
     *
     * @Route("/", name="groups_list")
     */
    public function groupsAction(ManagerRegistry $doctrine): Response
    {
        $groups = $doctrine->getRepository(ConcertGroup::class)->findAll();

        if(!$groups){
            throw $this->createNotFoundException(
                'Aucun groupe trouvé !'
            );
        }

        return $this->render('group/index.html.twig', [
            'groups' => $groups
        ]);
    }

    /**
     * @Route("/new", name="group_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $concertGroup = new ConcertGroup();
        $form = $this->createForm(ConcertGroupType::class, $concertGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file')->getData();

            $fileName = strtolower($concertGroup->getName());


            $fileName = $fileUploader->upload($file,'img/groups', $fileName);

            if(!$fileName) {
                return $this->renderForm('group/new.html.twig', [
                    'group' => $concertGroup,
                    'form' => $form,
                ]);
            }

            $concertGroup->setImgName($fileName);

            $entityManager->persist($concertGroup);
            $entityManager->flush();

            return $this->redirectToRoute('groups_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('group/new.html.twig', [
            'group' => $concertGroup,
            'form' => $form,
        ]);
    }

    /**
     * Affiche un groupe en particulier.
     *
     * @Route("/{id}", name="groups_show")
     */
    public function groupAction(ManagerRegistry $doctrine, int $id): Response
    {
        $group = $doctrine->getRepository(ConcertGroup::class)->find($id);
        $concerts = $doctrine->getRepository(ConcertConcert::class)->getNextGroupConcert($id);

        if(!$group){
            throw $this->createNotFoundException(
                'Aucun groupe trouvé !'
            );
        }

        $artists = $group->getConcertArtists();

        return $this->render('group/group.html.twig', [
            'controller_name' => 'GroupController',
            'group' => $group,
            'artists' => $artists,
            'concerts' => $concerts
        ]);
    }

    /**
     * @Route("/edit/{id}", name="group_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(ConcertGroup $concertGroup, Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {

        $form = $this->createForm(ConcertGroupType::class, $concertGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file')->getData();

            $fileName = strtolower($concertGroup->getName());


            $fileName = $fileUploader->upload($file,'img/groups', $fileName);

            if(!$fileName) {
                return $this->renderForm('artist/new.html.twig', [
                    'group' => $concertGroup,
                    'form' => $form,
                ]);
            }

            unlink('img/groups/' . $concertGroup->getImgName());
            $concertGroup->setImgName($fileName);


            $entityManager->flush();

            return $this->redirectToRoute('groups_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('group/edit.html.twig', [
            'group' => $concertGroup,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="group_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, ConcertGroup $concertGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concertGroup->getId(), $request->request->get('_token'))) {
            unlink('img/groups/' . $concertGroup->getImgName());
            $entityManager->remove($concertGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('groups_list', [], Response::HTTP_SEE_OTHER);
    }
}
