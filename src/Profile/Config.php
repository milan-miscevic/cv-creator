<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Profile;

class Config
{
    public function __construct(
        public string $positionDateFormat,
        public string $educationDateFormat,
        public string $locale,
    ) {
    }
}
