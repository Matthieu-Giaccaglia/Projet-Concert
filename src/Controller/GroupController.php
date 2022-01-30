<?php

namespace App\Controller;

use App\Entity\ConcertConcert;
use App\Entity\ConcertGroup;
use App\Form\ConcertGroupType;
use App\Repository\ConcertGroupRepository;
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
     * Show list of groups for regular user.
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     *
     * @Route("", name="group_index")
     */
    public function indexAction(ManagerRegistry $doctrine): Response
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
     * Show list of groups for admin.
     *
     * @param ConcertGroupRepository $groupRepository
     * @return Response
     *
     * @Route("/list", name="group_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function listAction(ConcertGroupRepository $groupRepository): Response
    {
        return $this->render('group/list.html.twig', [
            'groups' => $groupRepository->findAll()
        ]);
    }

    /**
     * Show information of a group.
     *
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     *
     * @Route("/{id}", name="group_show", requirements={"id"="\d+"})
     */
    public function showAction(ManagerRegistry $doctrine, int $id): Response
    {
        $group = $doctrine->getRepository(ConcertGroup::class)->find($id);
        $concerts = $doctrine->getRepository(ConcertConcert::class)->getNextGroupConcert($id);

        if(!$group){
            throw $this->createNotFoundException(
                'Aucun groupe trouvé !'
            );
        }

        $artists = $group->getConcertArtists();

        return $this->render('group/show.html.twig', [
            'controller_name' => 'GroupController',
            'group' => $group,
            'artists' => $artists,
            'concerts' => $concerts
        ]);
    }

    /**
     * To create a new groupe
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param FileUploader $fileUploader
     * @return Response
     *
     * @Route("/new", name="group_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
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

            return $this->redirectToRoute('group_show', ['id'=>$concertGroup->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('group/new.html.twig', [
            'group' => $concertGroup,
            'form' => $form,
        ]);
    }

    /**
     * To edit a group.
     *
     * @param ConcertGroup $concertGroup
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param FileUploader $fileUploader
     * @return Response
     *
     * @Route("/{id}/edit", name="group_edit", requirements={"id"="\d+"}, methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(ConcertGroup $concertGroup, Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
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

            return $this->redirectToRoute('group_show', ['id'=>$concertGroup->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('group/edit.html.twig', [
            'group' => $concertGroup,
            'form' => $form,
        ]);
    }

    /**
     * To delete a group.
     *
     * @param Request $request
     * @param ConcertGroup $concertGroup
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     * @Route("/{id}/delete", name="group_delete", requirements={"id"="\d+"}, methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Request $request, ConcertGroup $concertGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concertGroup->getId(), $request->request->get('_token'))) {
            unlink('img/groups/' . $concertGroup->getImgName());
            $entityManager->remove($concertGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_index', [], Response::HTTP_SEE_OTHER);
    }
}
