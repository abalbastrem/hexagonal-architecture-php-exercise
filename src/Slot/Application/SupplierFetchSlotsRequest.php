<?php
declare(strict_types=1);

namespace App\Slot\Application;


use App\Slot\Domain\Entity\SlotsCollection;
use App\Slot\Domain\ISupplierSlotsRepository;

class SupplierFetchSlotsRequest implements FetchSlotsRequest
{
    private ISupplierSlotsRepository $slotRepository;

    public function fetchAll(): SlotsCollection
    {
        return $this->slotRepository->fetchAll();
    }
}