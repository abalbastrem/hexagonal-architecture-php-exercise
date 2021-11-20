<?php
declare(strict_types=1);

namespace App\Slot\Application;


use App\Slot\Domain\Entity\SlotsCollection;
use App\Slot\Domain\ISupplierSlotsRepository;

class SupplierFetchSlotsRequest implements FetchSlotsRequest
{
    private ISupplierSlotsRepository $supplierSlotRepository;

    public function __construct(ISupplierSlotsRepository $supplierSlotRepository) {
        $this->supplierSlotRepository = $supplierSlotRepository;
    }

    public function fetchAll(): SlotsCollection
    {
        return $this->supplierSlotRepository->fetchAll();
    }
}