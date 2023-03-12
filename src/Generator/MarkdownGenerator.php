<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Generator;

use Mmm\CvCreator\Profile\Profile;
use Throwable;

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

    public function __construct(private string $rootFolder)
    {
    }

    public function generate(Profile $profile, Config $config): string
    {
        try {
            $template = $this->rootFolder . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $config->format . '.php';

            $toExtract = ['translations' => self::TRANSLATIONS[$config->language]];
            extract($toExtract);

            ob_start();
            require $template;
            $content = (string) ob_get_contents();
            ob_end_clean();

            return $content;
        } catch (Throwable $ex) {
            echo $ex->getMessage();
            throw $ex;
        }
    }
}
