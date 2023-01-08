<?php

declare(strict_types=1);

namespace Mmm\Cv\Profile;

class Config
{
    public function __construct(
        public string $positionDateFormat,
        public string $educationDateFormat,
        public string $locale,
    ) {
    }
}
