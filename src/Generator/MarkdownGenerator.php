<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Generator;

use DateTimeInterface;
use IntlDateFormatter;
use Mmm\CvCreator\Profile\Language;
use Mmm\CvCreator\Profile\LanguageLevel;
use Mmm\CvCreator\Profile\Profile;
use Mmm\CvCreator\Profile\Project;
use Mmm\CvCreator\Profile\Technological;

class MarkdownGenerator
{
    public function __construct(private Translator $translator)
    {
    }

    private function a(string $text, string $url): string
    {
        return sprintf('[%s](%s)', $text, $url);
    }

    private function h1(string $title): string
    {
        return '# ' . $title;
    }

    private function h2(string $title): string
    {
        return '## ' . $title;
    }

    private function h3(string $title): string
    {
        return '### ' . $title;
    }

    private function i(string $text): string
    {
        return sprintf('*%s*', $text);
    }

    public function formatDateMd(?DateTimeInterface $dateTime, string $format, string $present, string $locale): string
    {
        if ($dateTime === null) {
            return $present;
        }

        $formatter = new IntlDateFormatter($locale, 0, 0);
        $formatter->setPattern($format);
        return (string) $formatter->format($dateTime);
    }

    /**
     * @param Technological[] $technologies
     */
    public function formatTechnologiesMd(array $technologies): string
    {
        $f = function (Technological $technological): string {
            return $technological->getValue();
        };

        return implode(', ', array_map($f, $technologies));
    }

    /**
     * @param Project[] $projects
     */
    public function formatProjectsMd(array $projects): string
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

    public function generate(Profile $profile, Config $config): string
    {
        $result = [];

        $result[] = $this->h1($profile->about->name);

        $result[] = $this->h2($this->translator->t('profile', $config->language));
        $result[] = $profile->about->summary;

        if (count($profile->about->specialties) > 0) {
            $result[] = $this->translator->t('specialties', $config->language) . ': ' . implode(', ', $profile->about->specialties) . '.';
        }

        $result[] = $this->h2($this->translator->t('recent-work-experience', $config->language));
        foreach ($profile->positions as $job) {
            if ($job->company !== null) {
                $result[] = $this->h3(sprintf(
                    '%s %s %s',
                    $job->role,
                    $this->translator->t('at', $config->language),
                    (string) $job->company, // @todo remove cast
                ));
            } else {
                $result[] = $this->h3($job->role);
            }

            $result[] = $this->i(sprintf(
                '%s – %s',
                $this->formatDateMd(
                    $job->startDate,
                    $profile->config->positionDateFormat,
                    $this->translator->t('present', $config->language),
                    $profile->config->locale,
                ),
                $this->formatDateMd(
                    $job->endDate,
                    $profile->config->positionDateFormat,
                    $this->translator->t('present', $config->language),
                    $profile->config->locale,
                )
            ));

            $result[] = $job->description;

            if (count($job->technologies) > 0) {
                $result[] = $this->translator->t('technologies', $config->language) . ': ' . $this->formatTechnologiesMd($job->technologies) . '.';
            }

            if (count($job->projects) > 0) {
                $result[] = ((count($job->projects) > 1) ? $this->translator->t('projects', $config->language) : $this->translator->t('project', $config->language)) . ': ' . $this->formatProjectsMd($job->projects);
            }
        }

        $result[] = $this->h2($this->translator->t('education', $config->language));
        foreach ($profile->educations as $degree) {
            $result[] = $this->h3(sprintf(
                '%s, %s, %s',
                $degree->degree,
                $degree->school,
                $degree->location
            ));

            $result[] = $this->i(sprintf(
                $this->formatDateMd(
                    $degree->graduationDate,
                    $profile->config->educationDateFormat,
                    $this->translator->t('present', $config->language),
                    $profile->config->locale,
                )
            ));
        }

        $result[] = $this->h2($this->translator->t('details', $config->language));
        $result[] = $profile->contact->city;
        $result[] = $profile->contact->country;
        $result[] = $profile->contact->phone;
        $result[] = $this->a($profile->contact->email, 'mailto:' . $profile->contact->email);
        $result[] = $profile->contact->skype ? 'Skype: ' . $profile->contact->skype : null;

        $result[] = $this->h2($this->translator->t('links', $config->language));
        foreach ($profile->links as $link) {
            $result[] = $this->a($link->name, $link->url);
        }

        $result[] = $this->h2($this->translator->t('languages', $config->language));
        foreach ($profile->languages as $language) {
            $result[] = $this->language($language);
        }

        return implode("\n\n", array_filter($result)) . "\n";
    }

    private function language(Language $language): string
    {
        $f = function (LanguageLevel $level): string {
            return $level->name;
        };

        return sprintf(
            '%s (%s)',
            $language->name->name,
            implode('/', array_map($f, $language->level)),
        );
    }
}
