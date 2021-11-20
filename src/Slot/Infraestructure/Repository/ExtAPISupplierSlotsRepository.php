<?php


namespace App\Slot\Infraestructure\Repository;


use App\Slot\Domain\Entity\Slot;
use App\Slot\Domain\Entity\SlotsCollection;
use App\Slot\Domain\ISupplierSlotsRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ExtAPISupplierSlotsRepository extends ServiceEntityRepository implements ISupplierSlotsRepository
{
    // TODO put these in conf
    private $apiUrl = "http://cryptic-cove-05648.herokuapp.com";
    private $endpointDoctors = "/api/doctors";
    private $endpointSlots = "/api/doctors/{id}/slots";
    private $username = "docplanner";
    private $password = "docplanner";

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slot::class);
    }

    public function fetchAll(): SlotsCollection
    {
        // TODO: Implement fetchAll() method.
    }
}