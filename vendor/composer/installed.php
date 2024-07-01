<?php return array(
    'root' => array(
        'name' => 'your-vendor/smartmail-assistant',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '3ba0d144bada90564892694dea4c057d59d45d3c',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'openai/openai' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '3943a54d2a974d4b3246842846cb0cf4414aa308',
            'type' => 'library',
            'install_path' => __DIR__ . '/../openai/openai',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
        'your-vendor/smartmail-assistant' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '3ba0d144bada90564892694dea4c057d59d45d3c',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
