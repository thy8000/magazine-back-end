<?php

if(!defined('ABSPATH')) {
    echo 'Inicie WordPress';

    exit;
}

require implode(DIRECTORY_SEPARATOR, [__DIR__, '_ACF', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, '_Graphql', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'Categories', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'GlobalSettings', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'News', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'ThemeCustomizer', '_index.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, 'ThemeOptions', '_index.php']);
