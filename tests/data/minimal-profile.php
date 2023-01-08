<?php

declare(strict_types=1);

use Mmm\CvCreator\Profile\About;
use Mmm\CvCreator\Profile\Config;
use Mmm\CvCreator\Profile\Contact;
use Mmm\CvCreator\Profile\Profile;

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
