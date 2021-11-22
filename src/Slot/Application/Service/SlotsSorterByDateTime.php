<?php


namespace App\Slot\Application\Service;


use App\Slot\Domain\Entity\SlotCollection;

class SlotsSorterByDateTime implements SlotsSorter
{

    public function sort(SlotCollection $slotsCollection): SlotCollection
    {
        // TODO: Implement sort() method.
        return $slotsCollection;
    }
}