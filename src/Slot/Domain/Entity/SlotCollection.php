<?php
declare(strict_types=1);

namespace App\Slot\Domain\Entity;

use App\Slot\Domain\Transformer\SlotTransformer;

final class SlotCollection
{
    /** @var Slot[] */
    private array $slots;

    public function __construct()
    {
        $this->slots = array();
    }

    public function addSlot(Slot $slot): void
    {
        $this->slots[] = $slot;
    }

    public function getSlots(): array
    {
        return $this->slots;
    }

    /**
     * @return Slot[]
     * inner DateTimes are preserved
     */
    public function flatten(): array
    {
        $slotTransformer = new SlotTransformer();
        $slotObjects = array();
        if (count($this->getSlots()) == 0) {
            return $slotObjects;
        }
        foreach ($this->getSlots() as $slot) {
            $slotObjects[] = $slotTransformer->toStdClass($slot);
        }

        return $slotObjects;
    }
}
