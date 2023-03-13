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
    private const TRANSLATIONS = [
        'en' => [
            'at' => 'at',
            'details' => 'Details',
            'education' => 'Education',
            'languages' => 'Languages',
            'links' => 'Links',
            'present' => 'Present',
            'profile' => 'Profile',
            'project' => 'Project',
            'projects' => 'Projects',
            'recent-work-experience' => 'Recent work experience',
            'specialties' => 'Specialties',
            'technologies' => 'Technologies',
        ],
        'de' => [
            'at' => 'bei',
            'details' => 'Kontaktdetails',
            'education' => 'Ausbildung',
            'languages' => 'Sprachen',
            'links' => 'Links',
            'present' => 'heute',
            'profile' => 'Profil',
            'project' => '@todo',
            'projects' => '@todo',
            'recent-work-experience' => 'Werdegang',
            'specialties' => '@todo',
            'technologies' => '@todo',
        ],
    ];

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

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['profile']);
        $result[] = $profile->about->summary;

        if (count($profile->about->specialties) > 0) {
            $result[] = self::TRANSLATIONS[$config->language]['specialties'] . ': ' . implode(', ', $profile->about->specialties) . '.';
        }

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['recent-work-experience']);
        foreach ($profile->positions as $job) {
            $result[] = $this->h3(sprintf(
                '%s %s %s',
                $job->role,
                self::TRANSLATIONS[$config->language]['at'],
                (string) $job->company, // @todo remove cast
            ));

            $result[] = $this->i(sprintf(
                '%s – %s',
                $this->formatDateMd(
                    $job->startDate,
                    $profile->config->positionDateFormat,
                    self::TRANSLATIONS[$config->language]['present'],
                    $profile->config->locale,
                ),
                $this->formatDateMd(
                    $job->endDate,
                    $profile->config->positionDateFormat,
                    self::TRANSLATIONS[$config->language]['present'],
                    $profile->config->locale,
                )
            ));

            $result[] = $job->description;

            if (count($job->technologies) > 0) {
                $result[] = self::TRANSLATIONS[$config->language]['technologies'] . ': ' . $this->formatTechnologiesMd($job->technologies) . '.';
            }

            if (count($job->projects) > 0) {
                $result[] = ((count($job->projects) > 1) ? self::TRANSLATIONS[$config->language]['projects'] : self::TRANSLATIONS[$config->language]['project']) . ': ' . $this->formatProjectsMd($job->projects);
            }
        }

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['education']);
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
                    self::TRANSLATIONS[$config->language]['present'],
                    $profile->config->locale,
                )
            ));
        }

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['details']);
        $result[] = $profile->contact->city;
        $result[] = $profile->contact->country;
        $result[] = $profile->contact->phone;
        $result[] = $this->a($profile->contact->email, 'mailto:' . $profile->contact->email);
        $result[] = $profile->contact->skype ? 'Skype: ' . $profile->contact->skype : null;

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['links']);
        foreach ($profile->links as $link) {
            $result[] = $this->a($link->name, $link->url);
        }

        $result[] = $this->h2(self::TRANSLATIONS[$config->language]['languages']);
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
