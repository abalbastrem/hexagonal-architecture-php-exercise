<?php
declare(strict_types=1);

namespace App\Slot\Application;


use App\Slot\Domain\Entity\SlotsCollection;

interface FetchSlotsRequest
{
    public function fetchAll(): SlotsCollection;
}