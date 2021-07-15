<?php

namespace Drupal\pl_topic9task42\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;

/**
 * @MigrateProcessPlugin(
 *   id = "custom_plugin"
 * )
 */
class CustomProcessPlugin extends ProcessPluginBase {

  /**
   * Return concatenation firstname and reverse surname in string format.
   */
  public function transform($value, \Drupal\migrate\MigrateExecutableInterface $migrate_executable, \Drupal\migrate\Row $row, $destination_property) {
    if (is_array($value)) {
      /**
       * Reverse surname.
       */
      $reverse_surname = strrev($value[1]);
      $reverse_surname = strtolower($reverse_surname);
      $reverse_surname = ucfirst($reverse_surname);
      /**
       * Concatenation firstname with '-' and surname.
       */
      $concat = $value[0] . ' - ' . $reverse_surname;
      return $concat;
    }
  }
}
