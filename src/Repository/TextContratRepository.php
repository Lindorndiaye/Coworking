<?php

namespace App\Repository;

use App\Entity\TextContrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TextContrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextContrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextContrat[]    findAll()
 * @method TextContrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextContratRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TextContrat::class);
    }

//    /**
//     * @return TextContrat[] Returns an array of TextContrat objects
//     */
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
    public function findOneBySomeField($value): ?TextContrat
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
