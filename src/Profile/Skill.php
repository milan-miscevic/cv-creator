<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Profile;

class Skill
{
    public function __construct(
        public string $name,
        public string $level,
    ) {
    }
}
