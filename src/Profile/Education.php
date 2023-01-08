<?php

declare(strict_types=1);

namespace Mmm\Cv\Profile;

use DateTimeInterface;

class Education
{
    public function __construct(
        public string $degree,
        public string $school,
        public string $location,
        public ?DateTimeInterface $graduationDate,
    ) {
    }
}
