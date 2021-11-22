<?php


namespace App\Slot\Application\Service;


use App\Slot\Application\PullSlotsRequest;
use App\Slot\Domain\ISlotRepository;
use App\Slot\Domain\ISupplierSlotsRepository;

class PullSlotsService
{
    private ISupplierSlotsRepository $supplierSlotsRepository;
    private ISlotRepository $slotRepository;

    public function __construct(ISupplierSlotsRepository $supplierSlotsRepository, ISlotRepository $slotRepository) {
        $this->supplierSlotsRepository = $supplierSlotsRepository;
        $this->slotRepository = $slotRepository;
    }

    // TODO extend Response?
    public function pull(PullSlotsRequest $request) {
        $fetchArgs = $request->getArgs();
        $slots = $this->supplierSlotsRepository->fetchAll($fetchArgs);
        $this->slotRepository->saveAll($slots);
    }

}