<?php

declare(strict_types=1);

use Mmm\Cv\Profile\About;
use Mmm\Cv\Profile\Config;
use Mmm\Cv\Profile\Contact;
use Mmm\Cv\Profile\Education;
use Mmm\Cv\Profile\Language;
use Mmm\Cv\Profile\LanguageLevel;
use Mmm\Cv\Profile\LanguageName;
use Mmm\Cv\Profile\Link;
use Mmm\Cv\Profile\Position;
use Mmm\Cv\Profile\Profile;
use Mmm\Cv\Profile\Project;
use Mmm\Cv\Profile\Technology;
use Mmm\Cv\Profile\TechnologyGroup;

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
