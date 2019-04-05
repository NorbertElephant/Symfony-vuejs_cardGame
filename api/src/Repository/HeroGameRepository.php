<?php

namespace App\Repository;

use App\Entity\HeroGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HeroGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroGame[]    findAll()
 * @method HeroGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroGameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HeroGame::class);
    }

    // /**
    //  * @return HeroGame[] Returns an array of HeroGame objects
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
    public function findOneBySomeField($value): ?HeroGame
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
