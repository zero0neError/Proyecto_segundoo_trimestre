<?php

namespace App\Repository;

use App\Entity\ReservaProducto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservaProducto|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservaProducto|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservaProducto[]    findAll()
 * @method ReservaProducto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservaProducto::class);
    }

    // /**
    //  * @return ReservaProducto[] Returns an array of ReservaProducto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservaProducto
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
