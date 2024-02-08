<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Parser;
use Doctrine\Persistence\ManagerRegistry;
use Eltharin\AutomaticQueryBuilderBundle\DataCollector\PoweredRepositoryCollector;
use Eltharin\AutomaticQueryBuilderBundle\Repository\PoweredRepository;
use Eltharin\AutomaticQueryBuilderBundle\Service\QueryBuilderMaker;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
	private RequestStack $requestStack;

	public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
    {
        parent::__construct($registry, Serie::class);
	    $this->requestStack = $requestStack;
    }

    public function add(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Serie[] Returns an array of Serie objects
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

//    public function findOneBySomeField($value): ?Serie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

	public function getDQLMine()
	{
		return $this
			->createQueryBuilder('s0_')

			->leftJoin('s0_.itemSeries','i1_')->addSelect('i1_')
			->leftJoin('i1_.item','i2_')->addSelect('i2_')
			->leftJoin('s0_.serieImportators','s4_')->addSelect('s4_')
			->leftJoin('s4_.serie','s5_')->addSelect('s5_')
			->leftJoin('s5_.itemSeries','i6_')->addSelect('i6_')

;
	}

	public function findALlMine()
	{
		return $this->getDQLMine()
			->getQuery()
			->getResult();
	}
	public function findMine($id)
	{
		$ret =  $this->getDQLMine()
			->andWhere('serie.id = :serieId')
			->setParameter('serieId', $id)
			->getQuery();

		return $ret->getOneOrNullResult();
	}
}
