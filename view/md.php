<?php

declare(strict_types=1);

use Mmm\CvCreator\Generator\Config;
use Mmm\CvCreator\Profile\LanguageLevel;
use Mmm\CvCreator\Profile\Profile;
use Mmm\CvCreator\Profile\Project;
use Mmm\CvCreator\Profile\Technological;

if (!function_exists('formatDateMd')) {
    function formatDateMd(?DateTimeInterface $dateTime, string $format, string $present, string $locale): string
    {
        if ($dateTime === null) {
            return $present;
        }

        $formatter = new \IntlDateFormatter($locale, 0, 0);
        $formatter->setPattern($format);
        return (string) $formatter->format($dateTime);
    }

    /**
     * @param Technological[] $technologies
     */
    function formatTechnologiesMd(array $technologies): string
    {
        $f = function (Technological $technological): string {
            return $technological->getValue();
        };

        return implode(', ', array_map($f, $technologies));
    }

    /**
     * @param Project[] $projects
     */
    function formatProjectsMd(array $projects): string
    {
        $f = function (Project $project): string {
            return sprintf(
                '[%s](%s)',
                $project->name,
                $project->url,
            );
        };

        return implode(', ', array_map($f, $projects));
    }

    /**
     * @param LanguageLevel[] $levels
     */
    function formatLanguageLevelsMd(array $levels): string
    {
        $f = function (LanguageLevel $level): string {
            return $level->name;
        };

        return implode('/', array_map($f, $levels));
    }
}

/**
 * @var array<string, string> $translations
 * @var Config $config
 * @var Profile $profile
 */

?># <?= $profile->about->name ?>


## <?= $translations['profile'] ?>


<?= $profile->about->summary ?>


<?php if (count($profile->about->specialties) > 0) { ?>
<?= $translations['specialties'] ?>: <?= implode(', ', $profile->about->specialties) ?>.
<?php } ?>

## <?= $translations['recent-work-experience'] ?>

<?php

foreach ($profile->positions as $index => $job) {
    if ($index >= $config->recentPositionsCount) {
        break;
    }

    ?>

### <?= $job->role ?> <?= $translations['at'] ?> <?= $job->company ?>


*<?= formatDateMd($job->startDate, $profile->config->positionDateFormat, $translations['present'], $profile->config->locale) ?> – <?= formatDateMd($job->endDate, $profile->config->positionDateFormat, $translations['present'], $profile->config->locale) ?>*

<?= $job->description ?>


<?php if (count($job->technologies) > 0) { ?>
<?= $translations['technologies'] ?>: <?= formatTechnologiesMd($job->technologies) ?>.
<?php } ?>

<?php if (count($job->projects) > 0) { ?>
<?= (count($job->projects) > 1) ? $translations['projects'] : $translations['project'] ?>: <?= formatProjectsMd($job->projects) ?>
<?php } ?>

<?php } ?>

## <?= $translations['education'] ?>

<?php foreach ($profile->educations as $degree) { ?>

### <?= $degree->degree ?>, <?= $degree->school ?>, <?= $degree->location ?>


*<?= formatDateMd($degree->graduationDate, $profile->config->educationDateFormat, $translations['present'], $profile->config->locale) ?>*
<?php } ?>

## <?= $translations['details'] ?>


<?= $profile->contact->city ?>


<?php if ($profile->contact->country !== null) { ?>
<?= $profile->contact->country ?>
<?php } ?>

<?= $profile->contact->phone ?>

[<?= $profile->contact->email ?>](mailto:<?= $profile->contact->email ?>)

<?php if ($profile->contact->skype !== null) { ?>
Skype: <?= $profile->contact->skype ?>

<?php } ?>

## <?= $translations['links'] ?>

<?php foreach ($profile->links as $link) { ?>

[<?= $link->name ?>](<?= $link->url ?>)
<?php } ?>

## <?= $translations['languages'] ?>


<?php foreach ($profile->languages as $language) { ?>
<?= $language->name->name ?> (<?= formatLanguageLevelsMd($language->level) ?>)

<?php } ?>
