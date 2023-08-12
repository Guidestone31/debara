<?php

namespace App\Repository;

use App\Entity\VilleDeFrance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VilleDeFrance>
 *
 * @method VilleDeFrance|null find($id, $lockMode = null, $lockVersion = null)
 * @method VilleDeFrance|null findOneBy(array $criteria, array $orderBy = null)
 * @method VilleDeFrance[]    findAll()
 * @method VilleDeFrance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleDeFranceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VilleDeFrance::class);
    }

//    /**
//     * @return VilleDeFrance[] Returns an array of VilleDeFrance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VilleDeFrance
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
