<?php
require __DIR__ . '/../vendor/autoload.php';

(new InsteadSite\Application(require __DIR__ . '/../.settings.php'))->run();
