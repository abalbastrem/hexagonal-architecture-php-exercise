<?php


namespace App\Slot\Domain\Transformer;


use App\Slot\Domain\Entity\Slot;

class SlotTransformer
{
    public function toStdClass(Slot $slot): \StdClass {
        $obj = new \StdClass();

        $obj->id = $slot->getId();
        $obj->dateFrom = $slot->getDateFrom();
        $obj->dateTo = $slot->getDateTo();
        $obj->doctorId = $slot->getDoctorId();

        return $obj;
    }

    public function fromStdClass(\StdClass $obj): Slot {
        $slot = new Slot();

        $slot->setDoctorId($obj->doctorId);
        $slot->setDateFrom($obj->dateFrom);
        $slot->setDateTo($obj->dateTo);

        return $slot;
    }
}