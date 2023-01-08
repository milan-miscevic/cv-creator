<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Tests\Generator;

use Mmm\CvCreator\Generator\Config;
use Mmm\CvCreator\Generator\Generator;
use Mmm\CvCreator\Profile\Profile;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testData(
        Profile $profile,
        string $language,
        int $recentPositionsCount,
        string $format,
        string $generatedCv
    ): void {
        $rootFolder = dirname(dirname(dirname(__FILE__)));
        $generator = new Generator($rootFolder);

        $this->assertSame(
            file_get_contents($generatedCv),
            $generator->generate(
                $profile,
                new Config(
                    $language,
                    $recentPositionsCount,
                    $format,
                ),
            ),
        );
    }

    /**
     * @return mixed[][]
     */
    public function dataProvider(): array
    {
        $rootFolder = dirname(dirname(dirname(__FILE__)));

        return [
            [
                require implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'minimal-profile.php']),
                'en',
                99,
                'html',
                implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'minimal-profile.htm']),
            ],
            [
                require implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'full-profile.php']),
                'en',
                99,
                'html',
                implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'full-profile.htm']),
            ],
        ];
    }
}
