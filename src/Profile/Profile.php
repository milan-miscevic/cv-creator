<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Profile;

class Profile
{
    public function __construct(
        public About $about,
        /** @var Position[] */
        public array $positions,
        /** @var Education[] */
        public array $educations,
        public Contact $contact,
        /** @var Link[] */
        public array $links,
        /** @var Language[] */
        public array $languages,
        public Config $config,
        /** @var Software[] */
        public array $software = [],
        /** @var Skill[] */
        public array $skills = [],
    ) {
    }
}
