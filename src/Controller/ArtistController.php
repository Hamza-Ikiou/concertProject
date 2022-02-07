<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * Affiche la liste des artistes
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     * @Route("/artists", name="artist_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function list(ManagerRegistry $doctrine): Response
    {
        $artist = $doctrine->getRepository(Artist::class)->findAll();
        return $this->render('artist/list.html.twig', ['listArtist' => $artist]);
    }

    /**
     * Créer un nouvel artiste
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     * @Route("/artists/create", name="artist_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function createArtist(ManagerRegistry $doctrine, Request $request): Response
    {
        $artist = new Artist();

        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('artist_list');
        }

        return $this->render('artist/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Supprimer un artiste
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Artist $artist
     * @return Response
     * @Route("/artists/delete/{id}", name="artist_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteArtist(ManagerRegistry $doctrine, Request $request, Artist $artist): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($artist);
        $entityManager->flush();

        return $this->redirectToRoute('artist_list');
    }

    /**
     * Modifier un artiste
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Artist $artist
     * @return Response
     * @Route("/artist/edit/{id}", name="artist_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editArtist(ManagerRegistry $doctrine, Request $request, Artist $artist): Response
    {

        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('artist_list');
        }

        return $this->render('artist/new.html.twig', ['form' => $form->createView()]);
    }
}
