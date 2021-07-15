<?php

namespace Drupal\pl_topic9task42\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;

/**
 * Return reversed string.
 *
 * @MigrateProcessPlugin(
 *   id = "custom_plugin"
 * )
 */
class CustomProcessPlugin extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, \Drupal\migrate\MigrateExecutableInterface $migrate_executable, \Drupal\migrate\Row $row, $destination_property) {
    if (is_array($value)) {
      $reverse_surname = strrev($value[1]);
      $concat = $value[0] . ' - ' . $reverse_surname;
      return $concat;
    }
  }

}
