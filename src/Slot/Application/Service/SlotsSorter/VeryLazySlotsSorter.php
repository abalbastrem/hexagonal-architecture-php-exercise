<?php
declare(strict_types=1);

namespace App\Slot\Application\Service\SlotsSorter;

use App\Slot\Application\Exception\SlotsSorter\TooManySlotsException;
use App\Slot\Domain\Entity\SlotCollection;

final class VeryLazySlotsSorter implements SlotsSorter
{
    private int $activeness;

    public function __construct(int $activeness)
    {
        $this->activeness = $activeness;
    }

    public function sort(SlotCollection $slotsCollection): SlotCollection
    {
        // This guy is sometimes that lazy it can't handle too many slots
        $slotsCount = count($slotsCollection->getSlots());
        if ($this->activeness < $slotsCount) {
            throw TooManySlotsException::whenTooLazyForSlots($this->activeness, $slotsCount);
        }
        // And even though, it's so lazy it still does nothing with them
        return $slotsCollection;
    }
}
