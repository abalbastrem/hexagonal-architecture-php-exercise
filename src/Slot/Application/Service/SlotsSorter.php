<?php
declare(strict_types=1);

namespace App\Slot\Application\Service;

use App\Slot\Domain\Entity\SlotCollection;

interface SlotsSorter
{
    public function sort(SlotCollection $slotsCollection): SlotCollection;
}
