<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Generator;

class Config
{
    public function __construct(
        public string $language,
        public int $recentPositionsCount,
        public string $format,
    ) {
    }
}
