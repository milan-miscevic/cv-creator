<?php

declare(strict_types=1);

namespace Mmm\CvCreator\Generator;

use Mmm\CvCreator\Profile\Profile;
use Throwable;

class HtmlGenerator
{
    public function __construct(
        private Translator $translator,
        private string $rootFolder,
    ) {
    }

    public function generate(Profile $profile, Config $config): string
    {
        try {
            $template = $this->rootFolder . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $config->format . '.php';

            $toExtract = ['translations' => $this->translator->pull($config->language)];
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
