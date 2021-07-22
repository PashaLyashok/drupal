<?php
/**
 * @file
 * File for custom token hooks.
 */
use Drupal\Core\Render\BubbleableMetadata;

/**
 * Implements hook_token_info().
 */
function pl_topic13task80_token_info() {

  return [
    'types' => [
      'custom' => [
        'name' => 'Custom token',
        'description' => 'Example custom token',
      ],
    ],
    'tokens' => [
      'custom' => [
        'link_to_google' => [
          'name' => 'Google Link',
          'description' => 'Link to google search services',
        ],
      ],
    ],
  ];
}

/**
 * Implements hook_tokens().
 */
function pl_topic13task80_tokens($type, $tokens, array $data, array $options, BubbleableMetadata $bubbleable_metadata) {
  $replacements = [];
  if ($type == 'custom') {
    foreach ($tokens as $name => $original) {
      switch ($name) {
        case 'link_to_google':
          $replacements[$original] = \Drupal\Core\Render\Markup::create('<a href="http://google.com" target="_blank">google.com</a>');
          break;
      }
    }
  }

  return $replacements;
}

