<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Profile;

class Project
{
    public function __construct(
        public string $name,
        public string $url,
    ) {
    }
}
