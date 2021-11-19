<?php
declare(strict_types=1);

namespace App\Slot\Application\Service;

use App\Slot\Domain\Entity\SlotsCollection;

interface SlotsSorter
{
    public function sort(SlotsCollection $slotsCollection): SlotsCollection;
}
