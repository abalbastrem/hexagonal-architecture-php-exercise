<?php


namespace App\Tests\Service;


use App\Slot\Application\Service\SlotsSorter\SlotsSorterByDateTime;

class DurationSlotSorterTest extends AbstractSlotSorterTest
{
    public function testItSortsSlotsByDuration()
    {
        $sorter = new SlotsSorterByDateTime();
        $collection = $this->createSlotsCollection(10);

        $sortedSlots = $sorter->sort($collection);

        $isCollectionSorted = true;
        $iterDuration = PHP_INT_MAX;
        foreach ($sortedSlots->getSlots() as $sortedSlot) {
            $sortedSlotDateFrom = $sortedSlot->getDateFrom();
            $sortedSlotDateTo = $sortedSlot->getDateTo();
            $sortedSlotDuration = $sortedSlotDateTo->getTimestamp() - $sortedSlotDateFrom->getTimestamp();
            if ($sortedSlotDuration < $iterDuration) {
                $iterDuration = $sortedSlotDateFrom->getTimestamp();
            } elseif ($sortedSlotDuration > $iterDuration) {
                $isCollectionSorted = false;
                break;
            }
        }

        $this->assertTrue($isCollectionSorted);
    }
}