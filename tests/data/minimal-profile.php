<?php

declare(strict_types=1);

use Mmm\Cv\Profile\About;
use Mmm\Cv\Profile\Config;
use Mmm\Cv\Profile\Contact;
use Mmm\Cv\Profile\Profile;

return new Profile(
    new About(
        null,
        'Joe Sixpack',
        'Student',
        'I am a student without any working experience.',
        [],
    ),
    [],
    [],
    new Contact(
        'My City',
        null,
        '+12 34 567890',
        'joe.sixpack@example.com',
        null,
    ),
    [],
    [],
    new Config('yyyy', 'LLLL yyyy', 'en_US'),
);
