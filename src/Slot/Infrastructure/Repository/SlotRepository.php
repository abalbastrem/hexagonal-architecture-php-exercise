<?php

namespace App\Slot\Infrastructure\Repository;

use App\Slot\Domain\Entity\Slot;
use App\Slot\Domain\ISlotRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Slot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Slot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Slot[]    findAll()
 * @method Slot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotRepository extends ServiceEntityRepository implements ISlotRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slot::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveAll(array $slots)
    {
        foreach ($slots as $slot) {
            $this->_em->persist($slot);
        }
        $this->_em->flush();
    }

    public function findByCriteria(array $criteria): array
    {
        // TODO use Criteria
//        $doctrineCriteria = new Criteria();
//        $doctrineCriteria
//            ->where(Criteria::expr()->eq('doctor_id', 0))
//            ->where(Criteria::expr()->gt('date_from', $criteria['dateFrom']->format("Y-m-d H:i:s")))
//            ->andWhere(Criteria::expr()->lt('date_to', $criteria['dateTo']->format("Y-m-d H:i:s")));
//        $slots = $this->matching($doctrineCriteria);

        $qb = $this->_em->createQueryBuilder();
        $qb->select("s")
            ->from(Slot::class, "s")
            ->where("s.dateFrom >= :dateFrom")
            ->andWhere("s.dateTo <= :dateTo")
            ->setParameter("dateFrom", $criteria['dateFrom']->format("Y-m-d H:i:s"))
            ->setParameter("dateTo", $criteria['dateTo']->format("Y-m-d H:i:s"));

        return $qb->getQuery()->getResult();
    }
}
