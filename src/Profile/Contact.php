<?php

declare(strict_types=1);

namespace Mmm\Cv\Profile;

class Contact
{
    public function __construct(
        public string $city,
        public ?string $country,
        public string $phone,
        public string $email,
        public ?string $skype,
    ) {
    }
}
