<?php


namespace App\Slot\Application\Service\SlotsSorter;


use App\Slot\Domain\Entity\SlotCollection;
use App\Slot\Domain\Transformer\SlotTransformer;

class SlotsSorterByDuration implements SlotsSorter
{

    public function sort(SlotCollection $slotCollection): SlotCollection
    {
        // TODO sort without losing Slot ID
        $sortedSlotCollection = new SlotCollection();
        $slotTransformer = new SlotTransformer();

        $slotCollectionFlat = $slotCollection->flatten();
        usort($slotCollectionFlat, function($a, $b) {
            $aDiff = $a->dateTo->getTimestamp() - $a->dateFrom->getTimestamp();
            $bDiff = $b->dateTo->getTimestamp() - $b->dateFrom->getTimestamp();
            if ($aDiff == $bDiff) return 0;
            if ($aDiff > $bDiff) return -1;
            if ($aDiff < $bDiff) return 1;
        });
        foreach ($slotCollectionFlat as $slotObj) {
            $sortedSlotCollection->addSlot($slotTransformer->fromStdClass($slotObj));
        }

        return $sortedSlotCollection;
    }
}