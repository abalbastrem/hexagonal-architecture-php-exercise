<?php


namespace App\Slot\Domain;


use App\Slot\Domain\Entity\SlotsCollection;

interface ISupplierSlotsRepository
{
    public function fetchAll(): SlotsCollection;
}