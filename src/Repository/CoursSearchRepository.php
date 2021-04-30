<?php

namespace App\Repository;

use App\Entity\CoursSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoursSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursSearch[]    findAll()
 * @method CoursSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursSearch::class);
    }

    // /**
    //  * @return CoursSearch[] Returns an array of CoursSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoursSearch
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
