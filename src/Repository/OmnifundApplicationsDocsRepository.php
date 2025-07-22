<?php

namespace App\Repository;

use App\Entity\OmnifundApplicationsDocs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method OmnifundApplicationsDocs|null find($id, $lockMode = null, $lockVersion = null)
 * @method OmnifundApplicationsDocs|null findOneBy(array $criteria, array $orderBy = null)
 * @method OmnifundApplicationsDocs[]    findAll()
 * @method OmnifundApplicationsDocs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OmnifundApplicationsDocsRepository extends ServiceEntityRepository
{
    public function __construct(\Doctrine\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, OmnifundApplicationsDocs::class);
    }

    // /**
    //  * @return OmnifundApplicationsDocs[] Returns an array of OmnifundApplicationsDocs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OmnifundApplicationsDocs
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
