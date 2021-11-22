<?php

namespace App\Slot\Infrastructure\Repository;

use App\Slot\Domain\Entity\Slot;
use App\Slot\Domain\ISlotRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        // TODO: Implement saveAll() method.
        foreach ($slots as $slot) {
            $this->_em->persist($slot);
//            $this->createQueryBuilder()->add();
        }
        $this->_em->flush();
    }
}
