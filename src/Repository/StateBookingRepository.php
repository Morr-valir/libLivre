<?php

namespace App\Repository;

use App\Entity\StateBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StateBooking>
 *
 * @method StateBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateBooking[]    findAll()
 * @method StateBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateBooking::class);
    }

    public function save(StateBooking $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StateBooking $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function stateSelected(String $value): StateBooking
    {
        return $this->createQueryBuilder("s")
        ->andWhere("s.name = :val")
        ->setParameter("val", $value)
        ->getQuery()
        ->getSingleResult();
    }

//    /**
//     * @return StateBooking[] Returns an array of StateBooking objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StateBooking
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
