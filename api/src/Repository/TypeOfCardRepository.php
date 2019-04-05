<?php

namespace App\Repository;

use App\Entity\TypeOfCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeOfCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfCard[]    findAll()
 * @method TypeOfCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeOfCard::class);
    }

    // /**
    //  * @return TypeOfCard[] Returns an array of TypeOfCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeOfCard
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
