<?php

namespace Drupal\pl_topic8task37\Batch;

use Drupal\Core\File\FileSystemInterface;
use Drupal\user\Entity\User;
use Drupal\Component\Utility\Random;

/**
 * Methods for running the CSV import in a batch.
 *
 * @package Drupal\csvimport
 */
class CsvImportBatch {

  /**
   * Handle batch completion.
   *
   *   Creates a new CSV file containing all failed rows if any.
   */
  public static function csvimportImportFinished($success, $results, $operations) {

    $messenger = \Drupal::messenger();

    if (!empty($results['failed_rows'])) {

      $dir = 'public://csv_files/';
      if (\Drupal::service('file_system')
        ->prepareDirectory($dir, FileSystemInterface::CREATE_DIRECTORY)) {

        // We validated extension on upload.
        $csv_filename = 'failed_rows-' . basename($results['uploaded_filename']);
        $csv_filepath = $dir . '/' . $csv_filename;

        $targs = [
          ':csv_url'      => file_create_url($csv_filepath),
          '@csv_filename' => $csv_filename,
          '@csv_filepath' => $csv_filepath,
        ];

        if ($handle = fopen($csv_filepath, 'w+')) {

          foreach ($results['failed_rows'] as $failed_row) {
            fputcsv($handle, $failed_row);
          }

          fclose($handle);
          $messenger->addMessage('Some rows failed to import. You may download a CSV of these rows: <a href=":csv_url">@csv_filename</a>', $targs, 'error');
        }
        else {
          $messenger->addMessage('Some rows failed to import, but unable to write error CSV to @csv_filepath', $targs, 'error');
        }
      }
      else {
        $messenger->addMessage('Some rows failed to import, but unable to create directory for error CSV at @csv_directory', 'error');
      }
    }

    return  $messenger->addMessage('The CSV import has completed.', 'status');
  }

  public static function csvimportRememberFilename($filename, &$context) {

    $context['results']['uploaded_filename'] = $filename;
  }

  public static function csvimportImportLine($line, &$context) {

    $context['results']['rows_imported']++;
    $line = array_map('base64_decode', $line);

    $context['message'] = t('Importing row !c' , ['!c' => $context['results']['rows_imported']]);

    if ($context['results']['rows_imported'] > 1) { 
      $new_name = new Random();
      $user = User::create([
        'name' => $new_name->name(5, TRUE),
        'mail' => $line[0],
        'pass' => $line[1],
        'status' => TRUE,
        'init' => $line[0],
      ]) ->save();   
    }
  }
}
