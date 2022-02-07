<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{

    /**
     * Affiche les détails d'un concert
     *
     * @param ManagerRegistry $doctrine
     * @param Concert $concert
     * @return Response
     * @Route("/concert/{id}", name="concert_show")
     */
    public function details(ManagerRegistry $doctrine, Concert $concert): Response
    {
        $c = $doctrine->getRepository(Concert::class)->find($concert);
        return $this->render('concert/show.html.twig', ['detailsConcert' => $c]);
    }

    /**
     * Créer un nouveau concert
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     * @Route("/concerts/create", name="concert_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function createConcert(ManagerRegistry $doctrine, Request $request): Response
    {
        $show = new Concert();

        $form = $this->createForm(ConcertType::class, $show);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($show);
            $entityManager->flush();

            return $this->redirectToRoute('concerts_list_creation');
        }

        return $this->render('concert/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Supprimer un concert
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Concert $concert
     * @return Response
     * @Route("/concerts/delete/{id}", name="concert_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteConcert(ManagerRegistry $doctrine, Request $request, Concert $concert): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('concerts_list_creation');
    }

    /**
     * Modifier un concert
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Concert $concert
     * @return Response
     * @Route("/concerts/edit/{id}", name="concert_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editConcert(ManagerRegistry $doctrine, Request $request, Concert $concert): Response
    {

        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concerts_list_creation');
        }

        return $this->render('concert/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Affiche la liste des concerts pour l'onglet home
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/concerts", name="concerts_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $concert = $doctrine->getRepository(Concert::class)->findIncoming();
        return $this->render('concert/list.html.twig', ['listConcert' => $concert]);
    }

    /**
     * Affiche la liste des concerts pour l'onglet concerts
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/concerts/admin", name="concerts_list_creation")
     * @IsGranted("ROLE_ADMIN")
     */
    public function listCreation(ManagerRegistry $doctrine): Response
    {
        $concert = $doctrine->getRepository(Concert::class)->findAll();
        return $this->render('concert/listCreate.html.twig', ['listConcertWithCreate' => $concert]);
    }

    /**
     * Affiche la liste des concerts archivés
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/concerts/archive", name="concerts_listArchive")
     */
    public function listArchive(ManagerRegistry $doctrine): Response
    {
        $concert = $doctrine->getRepository(Concert::class)->findArchive();
        return $this->render('concert/listArchive.html.twig', ['listConcertArchive' => $concert]);
    }
}
