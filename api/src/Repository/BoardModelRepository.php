<?php

namespace App\Repository;

use App\Entity\BoardModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BoardModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoardModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoardModel[]    findAll()
 * @method BoardModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BoardModel::class);
    }

    // /**
    //  * @return BoardModel[] Returns an array of BoardModel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BoardModel
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
