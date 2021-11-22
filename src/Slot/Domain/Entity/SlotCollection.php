<?php
declare(strict_types=1);

namespace App\Slot\Domain\Entity;

use App\Slot\Domain\Entity\Slot;

final class SlotCollection
{
    /** @var Slot[] */
    private array $slots;

    public function addSlot(Slot $slot): void
    {
        $this->slots[] = $slot;
    }

    public function addSlotArray(array $slots): void
    {
        foreach ($slots as $slot) {
            $this->addSlot($slot);
        }
    }

    public function getSlots(): array
    {
        return $this->slots;
    }
}
