<?php


namespace App\Tests\Service;


use App\Slot\Application\Service\SlotsSorter\SlotsSorterByDateTime;

class DatetimeSortSorterTest extends AbstractSlotSorterTest
{
    public function testItSortsSlotsByDatetime()
    {
        $sorter = new SlotsSorterByDateTime();
        $collection = $this->createSlotsCollection(10);

        $sortedSlots = $sorter->sort($collection);

        $isCollectionSorted = true;
        $iterDatetime = new \DateTime('1970-01-01 00:00:00');
        foreach ($sortedSlots->getSlots() as $sortedSlot) {
            $sortedSlotDatetime = $sortedSlot->getDateFrom();
            $diff = $sortedSlotDatetime->getTimestamp() - $iterDatetime->getTimestamp();
            if ($diff > 0) {
                $iterDatetime = $sortedSlotDatetime;
            } elseif ($diff < 0) {
                $isCollectionSorted = false;
                break;
            }
        }

        $this->assertTrue($isCollectionSorted);
    }
}