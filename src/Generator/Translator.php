<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Generator;

class Translator
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

    public function t(string $text, string $language): string
    {
        return self::TRANSLATIONS[$language][$text] ?? $text;
    }

    /**
     * @return array<string, string>
     */
    public function pull(string $language): array
    {
        return self::TRANSLATIONS[$language];
    }
}
