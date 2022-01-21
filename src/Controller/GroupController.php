<?php

namespace App\Controller;

use App\Entity\ConcertConcert;
use App\Entity\ConcertGroup;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\DoctrineConfig;

class GroupController extends AbstractController
{
    /**
     * Affiche tous les groupes.
     *
     * @Route("/groups", name="groups_list")
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
     * Affiche un groupe en particulier.
     *
     * @Route("/groups/{id}", name="groups_show")
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

        $artists = $group->getConcertArtist();

        return $this->render('group/group.html.twig', [
            'controller_name' => 'GroupController',
            'group' => $group,
            'artists' => $artists,
            'concerts' => $concerts
        ]);
    }
}
