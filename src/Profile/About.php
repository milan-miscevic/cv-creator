<?php

declare(strict_types=1);

namespace Mmm\Cv\Profile;

class About
{
    public function __construct(
        public ?string $picture,
        public string $name,
        public string $occupation,
        public string $summary,
        /** @var string[] */
        public array $specialties,
    ) {
    }
}
