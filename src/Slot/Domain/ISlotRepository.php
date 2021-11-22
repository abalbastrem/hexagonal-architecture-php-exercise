<?php


namespace App\Slot\Domain;


use App\Slot\Domain\Entity\Slot;

interface ISlotRepository
{
    public function saveAll(array $slots);
}