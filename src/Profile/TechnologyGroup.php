<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Profile;

class TechnologyGroup implements Technological
{
    public function __construct(
        public Technology $mainTechnology,
        /** @var Technology[] */
        public array $subtechnologies,
    ) {
    }

    public function getValue(): string
    {
        $subtechnologies = array_map(
            function (Technology $value): string {
                return $value->getValue();
            },
            $this->subtechnologies,
        );

        return sprintf(
            '%s (%s)',
            $this->mainTechnology->getValue(),
            implode(', ', $subtechnologies),
        );
    }
}
