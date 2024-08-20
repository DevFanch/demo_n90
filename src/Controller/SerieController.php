<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/serie', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(): Response
    {
        return $this->render('serie/list.html.twig', [
            'title' => 'List Films',
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('serie/create.html.twig', [
            'title' => 'Create Serie',
        ]);
    }
    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'])]
    public function detail(): Response
    {
        return $this->render('serie/detail.html.twig', [
            'title' => 'Detail',
        ]);
    }
}
