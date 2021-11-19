<?php
declare(strict_types=1);

namespace App\Slot\Domain\Entity;

use App\Slot\Domain\Entity\Slot;

final class SlotsCollection
{
    /** @var Slot[] */
    private array $slots;

    public function addSlot(Slot $slot): void
    {
        $this->slots[] = $slot;
    }

    public function getSlots(): array
    {
        return $this->slots;
    }
}
