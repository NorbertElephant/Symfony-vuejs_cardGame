<?php

namespace App\Repository;

use App\Entity\CardGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CardGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardGame[]    findAll()
 * @method CardGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardGameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CardGame::class);
    }

    // /**
    //  * @return CardGame[] Returns an array of CardGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CardGame
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
