<?php


namespace App\Slot\Application\Service\SlotsSorter;


use App\Slot\Domain\Entity\SlotCollection;
use App\Slot\Domain\Transformer\SlotTransformer;

class SlotsSorterByDateTime implements SlotsSorter
{

    public function sort(SlotCollection $slotCollection): SlotCollection
    {
        // TODO sort without losing Slot ID
        $sortedSlotCollection = new SlotCollection();
        $slotTransformer = new SlotTransformer();

        $slotCollectionFlat = $slotCollection->flatten();
        usort($slotCollectionFlat, function($a, $b) {
            $diff = $a->dateFrom->getTimestamp() - $b->dateFrom->getTimestamp();
            if ($diff == 0) return 0;
            if ($diff > 0) return 1;
            if ($diff < 0) return -1;
        });
        foreach ($slotCollectionFlat as $slotObj) {
            $sortedSlotCollection->addSlot($slotTransformer->fromStdClass($slotObj));
        }

        return $sortedSlotCollection;
    }
}