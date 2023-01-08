<?php

declare(strict_types=1);

use Mmm\CvCreator\Profile\About;
use Mmm\CvCreator\Profile\Config;
use Mmm\CvCreator\Profile\Contact;
use Mmm\CvCreator\Profile\Education;
use Mmm\CvCreator\Profile\Language;
use Mmm\CvCreator\Profile\LanguageLevel;
use Mmm\CvCreator\Profile\LanguageName;
use Mmm\CvCreator\Profile\Link;
use Mmm\CvCreator\Profile\Position;
use Mmm\CvCreator\Profile\Profile;
use Mmm\CvCreator\Profile\Project;
use Mmm\CvCreator\Profile\Technology;
use Mmm\CvCreator\Profile\TechnologyGroup;

return new Profile(
    new About(
        'jane-smith.jpg',
        'Jane Smith',
        'Software developer',
        'I am a software developer with 7 years of working experience.',
        ['Java', 'PHP', 'object-oriented programming'],
    ),
    [
        new Position(
            'Software engineer',
            'My second company',
            new DateTimeImmutable('2022-01-01'),
            null,
            'My second company is a global leader in development of software for end users.',
            'Development of backend services, interviews.',
            [
                new TechnologyGroup(Technology::PHP, [Technology::Zend, Technology::Doctrine]),
                Technology::Linux,
            ],
            [
                new Project('Example.net', 'https://www.example.net/'),
                new Project('Example.org', 'https://www.example.org/'),
            ],
            'Organizator of company\'s chess club.',
        ),
        new Position(
            'Software developer',
            'My first company',
            new DateTimeImmutable('2015-05-01'),
            new DateTimeImmutable('2021-12-31'),
            'My second company is a regional leader in development of software for end users.',
            'Development of backend services.',
            [
                Technology::Java,
                Technology::Linux,
            ],
            [
                new Project('Example.com', 'https://www.example.com/'),
            ],
            'Winner of Hackathon.',
        ),
        new Position(
            'Volunteer',
            null,
            new DateTimeImmutable('2015-05-01'),
            null,
            null,
            'Volunteer to various organizations.',
            [],
            [],
            null,
        ),
    ],
    [
        new Education(
            'Software engineer',
            'University of Your City',
            'Your City',
            null,
        ),
        new Education(
            'Software engineer',
            'University of My City',
            'My City',
            new DateTimeImmutable('2015-04-01'),
        ),
    ],
    new Contact(
        'My City',
        'My Country',
        '+12 34 567890',
        'jane.smith@example.com',
        'jane.smith',
    ),
    [
        new Link('LinkedIn', 'https://www.linkedin.com/'),
        new Link('Stack Overflow', 'https://stackoverflow.com/'),
    ],
    [
        new Language(LanguageName::English, [LanguageLevel::C2]),
        new Language(LanguageName::German, [LanguageLevel::C1]),
        new Language(LanguageName::Spanish, [LanguageLevel::B1]),
        new Language(LanguageName::Chinese, [LanguageLevel::A1]),
    ],
    new Config('yyyy', 'LLLL yyyy', 'en_US'),
);
