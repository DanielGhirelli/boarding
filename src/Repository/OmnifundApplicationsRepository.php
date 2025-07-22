<?php

namespace App\Repository;

use App\Entity\OmnifundApplications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method OmnifundApplications|null find($id, $lockMode = null, $lockVersion = null)
 * @method OmnifundApplications|null findOneBy(array $criteria, array $orderBy = null)
 * @method OmnifundApplications[]    findAll()
 * @method OmnifundApplications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OmnifundApplicationsRepository extends ServiceEntityRepository
{
    public function __construct(\Doctrine\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, OmnifundApplications::class);
    }

//    /**
//     * @return OmnifundApplications[] Returns an array of OmnifundApplications objects
//     */
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
    public function findOneBySomeField($value): ?OmnifundApplications
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
