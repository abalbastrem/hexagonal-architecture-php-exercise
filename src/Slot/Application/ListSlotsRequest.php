<?php
declare(strict_types=1);

namespace App\Slot\Application;
use DateTime;

final class ListSlotsRequest
{
    private string $sortType;
    private DateTime $dateFrom;
    private DateTime $dateTo;
    private ?int $doctorId;

    public function __construct(string $sortType, DateTime $dateFrom, DateTime $dateTo, ?int $doctorId = null)
    {
        $this->sortType = $sortType;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->doctorId = $doctorId;
    }

    public function getSortType(): string
    {
        return $this->sortType;
    }

    public function getDateFrom(): DateTime
    {
        return $this->dateFrom;
    }

    public function getDateTo(): DateTime
    {
        return $this->dateTo;
    }

    public function getDoctorId(): ?int
    {
        return $this->doctorId;
    }
}
