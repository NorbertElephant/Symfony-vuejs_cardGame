<?php

namespace App\Repository;

use App\Entity\HeroModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HeroModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroModel[]    findAll()
 * @method HeroModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HeroModel::class);
    }

    // /**
    //  * @return HeroModel[] Returns an array of HeroModel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroModel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
