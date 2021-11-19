<?php
declare(strict_types=1);

namespace App\Slot\Application\Exception\SlotsSorter;

use App\Slot\Domain\Exception\DomainException;

final class TooManySlotsException extends DomainException
{
    public static function whenTooLazyForSlots(int $activeness, int $slotsCount): self
    {
        $message = sprintf(
            'You gave VeryLazySlotsSorter too many (%d) slots! It\'s too lazy to handle them!',
            $slotsCount - $activeness
        );

        return new self($message);
    }
}
