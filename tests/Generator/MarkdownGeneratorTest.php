<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Tests\Generator;

use Mmm\CvCreator\Generator\Config;
use Mmm\CvCreator\Generator\MarkdownGenerator;
use Mmm\CvCreator\Generator\Translator;
use Mmm\CvCreator\Profile\Profile;
use PHPUnit\Framework\TestCase;

class MarkdownGeneratorTest extends TestCase
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
        $generator = new MarkdownGenerator(new Translator());

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
    public static function dataProvider(): array
    {
        $rootFolder = dirname(dirname(dirname(__FILE__)));

        return [
            [
                require implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'full-profile.php']),
                'en',
                99,
                'md',
                implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'full-profile.md']),
            ],
            [
                require implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'minimal-profile.php']),
                'en',
                99,
                'md',
                implode(DIRECTORY_SEPARATOR, [$rootFolder, 'tests', 'data', 'minimal-profile.md']),
            ],
        ];
    }
}
