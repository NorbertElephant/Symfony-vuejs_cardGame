<?php

namespace App\Repository;

use App\Entity\DeckModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DeckModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeckModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeckModel[]    findAll()
 * @method DeckModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeckModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DeckModel::class);
    }

    // /**
    //  * @return DeckModel[] Returns an array of DeckModel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeckModel
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
