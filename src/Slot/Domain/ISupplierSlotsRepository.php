<?php


namespace App\Slot\Domain;


use App\Slot\Domain\Entity\SlotCollection;

interface ISupplierSlotsRepository
{
    public function fetchAll(array $args): array;
}