<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Item>
 *
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
	private RequestStack $requestStack;

	public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
	{
		parent::__construct($registry, Item::class);
		$this->requestStack = $requestStack;
	}

    public function add(Item $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Item $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Item[] Returns an array of Item objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Item
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

	public function getDQLMine()
	{
		return $this->createQueryBuilder('item')
					->leftJoin('item.teques','theque')->addSelect('theque')
					->leftJoin('item.itemSeries','itemseries')->addSelect('itemseries')
					->leftJoin('itemseries.serie','serie')->addSelect('serie')
					->andWhere('item.compte = :compte')
					->setParameter('compte', $this->requestStack->getSession()->get('compte', []))
			;
	}

	public function getAllMyItems(?UserInterface $getUser)
	{
		return $this->getDQLMine()
			->andWhere('theque.compte = :compte')
			->getQuery()->getResult();
	}
}
