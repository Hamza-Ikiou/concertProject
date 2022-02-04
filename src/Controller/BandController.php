<?php

namespace App\Controller;

use App\Entity\Band;
use App\Form\BandType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{
    /**
     * Affiche les détails d'un groupe
     *
     * @param ManagerRegistry $doctrine
     * @param Band $band
     * @return Response
     * @Route("/band/{id}", name="band_show")
     */
    public function details(ManagerRegistry $doctrine, Band $band): Response
    {
        $b = $doctrine->getRepository(Band::class)->find($band);
        return $this->render('band/show.html.twig', ['detailsBand' => $b]);
    }

    /**
     * Affiche la liste des groupes
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/bands", name="bands_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $band = $doctrine->getRepository(Band::class)->findAll();
        return $this->render('band/list.html.twig', ['listBand' => $band]);
    }

    /**
     * Créer un nouveau groupe
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     * @Route("/bands/create", name="band_create")
     * @isGranted("ROLE_ADMIN")
     */
    public function createBand(ManagerRegistry $doctrine, Request $request): Response
    {
        $band = new Band();

        $form = $this->createForm(BandType::class, $band);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('bands_list');
        }

        return $this->render('band/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Supprimer un groupe
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Band $band
     * @return Response
     * @Route("/bands/delete/{id}", name="band_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function deleteBand(ManagerRegistry $doctrine, Request $request, Band $band): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($band);
        $entityManager->flush();

        return $this->redirectToRoute('bands_list');
    }

    /**
     * Modifier un groupe
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Band $band
     * @return Response
     * @Route("/bands/edit/{id}", name="band_edit")
     * @isGranted("ROLE_ADMIN")
     */
    public function editBand(ManagerRegistry $doctrine, Request $request, Band $band): Response
    {

        $form = $this->createForm(BandType::class, $band);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('bands_list');
        }

        return $this->render('band/new.html.twig', ['form' => $form->createView()]);
    }

}
