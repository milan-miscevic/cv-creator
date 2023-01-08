<?php

declare(strict_types=1);

namespace Mmm\Cv\Profile;

class Language
{
    public function __construct(
        public LanguageName $name,
        /** @var LanguageLevel[] */
        public array $level,
    ) {
    }
}
