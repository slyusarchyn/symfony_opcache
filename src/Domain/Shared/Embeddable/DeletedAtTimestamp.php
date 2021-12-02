<?php

namespace App\Domain\Shared\Embeddable;

use DateTime;

class DeletedAtTimestamp
{
    public ?DateTime $deletedAt = null;

    public function setDeletedAt(): void
    {
        $this->deletedAt = new DateTime;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}
