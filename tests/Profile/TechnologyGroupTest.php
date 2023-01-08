<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Tests\Profile;

use Mmm\CvCreator\Profile\Technology;
use Mmm\CvCreator\Profile\TechnologyGroup;
use PHPUnit\Framework\TestCase;

class TechnologyGroupTest extends TestCase
{
    public function testData(): void
    {
        $group = new TechnologyGroup(
            Technology::PHP,
            [Technology::Laravel, Technology::Symfony, Technology::Zend],
        );

        $this->assertSame(Technology::PHP, $group->mainTechnology);
        $this->assertSame('PHP (Laravel, Symfony, Zend)', $group->getValue());

        $this->assertSame(
            [Technology::Laravel, Technology::Symfony, Technology::Zend],
            $group->subtechnologies
        );
    }
}
