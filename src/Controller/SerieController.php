<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/serie', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(SerieRepository $seriesRep): Response
    {

        return $this->render('serie/list.html.twig', [
            'title' => 'List Films',
            'series' => $seriesRep->findBy([], ['name' => 'ASC'], 30,0),
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
    public function detail(int $id, SerieRepository $seriesRep): Response
    {
        // create serie
//        $serie = new Serie();
//        $serie
//            ->setName('Serie ' . $id)
//            ->setBackdrop('Serie ' . $id)
//            ->setPoster('Serie ' . $id)
//            ->setDateCreated(new \DateTime())
//            ->setDateModified(new \DateTime())
//            ->setFirstAirDate(new \DateTime('-1 year'))
//            ->setLastAirDate(new \DateTime('-6 month'))
//            ->setGenres('Serie ' . $id)
//            ->setOverview('Serie ' . $id)
//            ->setPopularity(120.20)
//            ->setVote(5.30)
//            ->setStatus('Cancelled')
//            ->setTmdbId(987354);
//
//        dump($serie);
//        // Persist
//        $em->persist($serie);
//        $em->flush();
//
//        dump($serie);
//
//        // Edit serie
//        $serie->setName('Ma nouvelle série');
//        // Update
//        $em->flush();
//
//        dump($serie);


        $serie = $seriesRep->find($id);

        return $this->render('serie/detail.html.twig', [
            'title' => 'Detail',
            'serie' => $serie
        ]);
    }
}
