<?php

namespace App\Repository;

use App\Entity\Log;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Log>
 *
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Log::class);
    }

    public function getMostBookedBook(): array
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('name', 'name');
        $rsm->addScalarResult('amount', 'amount');
        $query = $this->getEntityManager()
            ->createNativeQuery('SELECT * FROM v_nb_reservations_par_livre LIMIT 1', $rsm);
        return $query->getResult();
    }

    public function getMostReturnedBook(): array
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('name', 'name');
        $rsm->addScalarResult('amount', 'amount');
        $query = $this->getEntityManager()
            ->createNativeQuery('SELECT * FROM v_nb_reservations_rendues_par_livre LIMIT 1', $rsm);
        return $query->getResult();
    }

    //    /**
    //     * @return Log[] Returns an array of Log objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Log
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
