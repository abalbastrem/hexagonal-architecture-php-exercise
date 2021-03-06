<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Slot\Domain\Entity\Slot;
use App\Slot\Domain\Entity\SlotCollection;
use PHPUnit\Framework\TestCase;

abstract class AbstractSlotSorterTest extends TestCase
{
    protected function createSlotsCollection(int $slotsCount): SlotCollection
    {
        $slotCollection = new SlotCollection();
        $date = new \DateTime('2020-02-01T14:10:00+00:00');
        $offsets = [-10, 0, 10];
        for ($i = 0; $i < $slotsCount; $i++) {
            $slot = (new Slot())
                ->setDoctorId(1)
                ->setDateFrom($date);

            $date->modify(sprintf('+%d minutes', $offsets[random_int(0, 2)]));

            $slot->setDateTo($date);
            $slotCollection->addSlot($slot);
        }

        return $slotCollection;
    }
}
