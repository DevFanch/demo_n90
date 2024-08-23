<?php

namespace App\Controller;

use App\Entity\Season;
use App\Form\SeasonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/season', name: 'season_')]
class SeasonController extends AbstractController
{

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $season = new Season();
        $seasonForm = $this->createForm(SeasonType::class, $season);

        $seasonForm->handleRequest($request);

        if ($seasonForm->isSubmitted() && $seasonForm->isValid()) {
            $em->persist($season);
            $em->flush();

            // Notif
            $this->addFlash('success', 'Season created');
            return $this->redirectToRoute('serie_list');
        }
        return $this->render('season/create.html.twig', [
            'title' => 'Add new Season',
            'seasonForm' => $seasonForm
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'delete', methods: ['GET'])]
    public function delete(Season $season, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($season);
        $entityManager->flush();

        // Notif
        $this->addFlash('success', 'Season deleted');

        return $this->redirectToRoute('app_home');
    }
}
