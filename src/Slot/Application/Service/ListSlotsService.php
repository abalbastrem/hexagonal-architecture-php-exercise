<?php


namespace App\Slot\Application\Service;


use App\Slot\Application\ListSlotsRequest;
use App\Slot\Domain\Entity\SlotCollection;
use App\Slot\Domain\ISlotRepository;

class ListSlotsService
{
    private ISlotRepository $slotRepository;

    public function __construct(ISlotRepository $slotRepository) {
        $this->slotRepository = $slotRepository;
    }

    public function list(ListSlotsRequest $request): SlotCollection {
        // TODO fix criteria
        $criteria = array(
//            'dateFrom' => $request->getDateFrom(),
//            'dateTo' => $request->getDateTo(),
//            'doctorId' => $request->getDoctorId()
        );
        $slots = $this->slotRepository->findBy($criteria);

        $slotCollection = new SlotCollection();
        $slotCollection->addSlotArray($slots);

        $slotsSorter = match ($request->getSortType()) {
            'duration' => new SlotsSorterByDuration(),
            'datetime' => new SlotsSorterByDateTime(),
            default => new VeryLazySlotsSorter(10000),
        };

        return $slotsSorter->sort($slotCollection);
    }
}