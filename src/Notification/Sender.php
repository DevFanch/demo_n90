<?php
namespace App\Notification;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class Sender 
{

    protected $repo;

    public function __construct(SerieRepository $serieRepo)
    {
        $this->repo = $serieRepo;
    }

    public function sendAjoutSerieWithSuccess(Serie $serie) {
        file_put_contents('debug.txt', $serie->getName());
        dump($this->repo->findAll());
    }
}