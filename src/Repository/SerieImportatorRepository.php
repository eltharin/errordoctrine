<?php

namespace App\Repository;

use App\Entity\SerieImportator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SerieImportator>
 *
 * @method SerieImportator|null find($id, $lockMode = null, $lockVersion = null)
 * @method SerieImportator|null findOneBy(array $criteria, array $orderBy = null)
 * @method SerieImportator[]    findAll()
 * @method SerieImportator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieImportatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SerieImportator::class);
    }

//    /**
//     * @return SerieImportator[] Returns an array of SerieImportator objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SerieImportator
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
