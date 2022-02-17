<?php

namespace App\Repository;

use App\Entity\TipoProducto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoProducto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoProducto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoProducto[]    findAll()
 * @method TipoProducto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoProducto::class);
    }

    // /**
    //  * @return TipoProducto[] Returns an array of TipoProducto objects
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
    public function findOneBySomeField($value): ?TipoProducto
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
