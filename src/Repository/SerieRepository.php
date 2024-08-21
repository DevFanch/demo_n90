<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

        /**
         * @return Serie[] Returns an array of Serie objects
         */
        public function findBestSeriesDQL(): array
        {
            $em = $this->getEntityManager();
            $dql =
                "Select s from App\Entity\Serie s
                Where s.vote > 8
                AND s.popularity > 150 
                ORDER BY s.popularity DESC";
            $q = $em->createQuery($dql);
            $q->setMaxResults(20);
            return $q->getResult();
        }

        public function findBestSeriesQB(): array
        {
            return $this->createQueryBuilder('s')
                ->andWhere('s.vote > 8')
                ->andWhere('s.popularity > 150')
                ->orderBy('s.popularity', 'DESC')
                ->setMaxResults(20)
                ->getQuery()
                ->getResult()
            ;
        }

    //    public function findOneBySomeField($value): ?Serie
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
