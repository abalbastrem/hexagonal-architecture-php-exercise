<?php


namespace App\Slot\Infraestructure\Repository;


use App\Slot\Domain\Entity\Slot;
use App\Slot\Domain\Entity\SlotsCollection;
use App\Slot\Domain\ISupplierSlotsRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExtAPISupplierSlotsRepository extends ServiceEntityRepository implements ISupplierSlotsRepository
{
    // TODO put these in conf
    private $apiUrl = "http://cryptic-cove-05648.herokuapp.com";
    private $endpointDoctors = "/api/doctors";
    private $endpointSlots = "/api/doctors/%u/slots";
    private $username = "docplanner";
    private $password = "docplanner";

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slot::class);
    }

    public function fetchAll(): SlotsCollection
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $this->endpointDoctors);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->username}:{$this->password}");
        $res = curl_exec($ch);

        $doctors = json_decode($res);

        $slotsCollection = new SlotsCollection();
        foreach ($doctors as $doctor) {
            curl_setopt($ch, CURLOPT_URL, $this->apiUrl . sprintf($this->endpointSlots, $doctor->id));
            $res = curl_exec($ch);
            $supplierSlotsByDoctor = json_decode($res);
            if (!empty($supplierSlotsByDoctor)) {
                foreach ($supplierSlotsByDoctor as $supplierSlot) {
                    $slot = new Slot();
                    $slot->setDoctorId($doctor->id);
                    $slot->setDateFrom(new \DateTime($supplierSlot->start));
                    $slot->setDateTo(new \DateTime($supplierSlot->end));
                    $slotsCollection->addSlot($slot);
                }
            }
        }

        curl_close($ch);

        return $slotsCollection;
    }
}