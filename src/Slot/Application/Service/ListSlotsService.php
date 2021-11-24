<?php


namespace App\Slot\Application\Service;


use App\Slot\Application\ListSlotsRequest;
use App\Slot\Application\Service\SlotsSorter\SlotsSorterByDateTime;
use App\Slot\Application\Service\SlotsSorter\SlotsSorterByDuration;
use App\Slot\Application\Service\SlotsSorter\VeryLazySlotsSorter;
use App\Slot\Domain\Entity\SlotCollection;
use App\Slot\Domain\ISlotRepository;

class ListSlotsService
{
    private ISlotRepository $slotRepository;

    public function __construct(ISlotRepository $slotRepository) {
        $this->slotRepository = $slotRepository;
    }

    public function list(ListSlotsRequest $request): SlotCollection {
        $criteria = array(
            'dateFrom' => $request->getDateFrom(),
            'dateTo' => $request->getDateTo()
        );
        $slots = $this->slotRepository->findByCriteria($criteria);
        if (empty($slots)) {
            return new SlotCollection();
        }

        $slotCollection = new SlotCollection();
        foreach ($slots as $slot) {
            $slotCollection->addSlot($slot);
        }

        $slotsSorter = match ($request->getSortType()) {
            'duration' => new SlotsSorterByDuration(),
            'datetime' => new SlotsSorterByDateTime(),
            default => new VeryLazySlotsSorter(3),
        };

        return $slotsSorter->sort($slotCollection);
    }
}