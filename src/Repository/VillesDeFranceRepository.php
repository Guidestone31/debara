<?php

namespace App\Repository;

use App\Entity\VillesDeFrance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VillesDeFrance>
 *
 * @method VillesDeFrance|null find($id, $lockMode = null, $lockVersion = null)
 * @method VillesDeFrance|null findOneBy(array $criteria, array $orderBy = null)
 * @method VillesDeFrance[]    findAll()
 * @method VillesDeFrance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VillesDeFranceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VillesDeFrance::class);
    }

//    /**
//     * @return VillesDeFrance[] Returns an array of VillesDeFrance objects
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

//    public function findOneBySomeField($value): ?VillesDeFrance
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
