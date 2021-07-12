<?php

namespace Drupal\pl_topic8task37\Form;

use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements form to upload a file and start the batch on form submit.
 */
class CsvImportForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'csvimport_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#attributes'] = [
      'enctype' => 'multipart/form-data',
    ];

    $form['csvfile'] = [
      '#title'            => $this->t('CSV File'),
      '#type'             => 'file',
      '#element_validate' => ['::validateFileupload'],
    ];

    $form['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Start Import'),
    ];

    return $form;
  }

  /**
   * Validate the file upload.
   */
  public static function validateFileupload(&$element, FormStateInterface $form_state, &$complete_form) {

    $validators = [
      'file_validate_extensions' => ['csv CSV'],
    ];

    if ($file = file_save_upload('csvfile', $validators, FALSE, 0, "FILE_EXISTS_REPLACE")) {
      $csv_dir = 'public://csv_files/';
      $directory_exists = \Drupal::service('file_system')
        ->prepareDirectory($csv_dir, FileSystemInterface::CREATE_DIRECTORY);

      if ($directory_exists) {
        $destination = $csv_dir . '/' . $file->getFilename();
        if (file_copy($file, $destination, FileSystemInterface::EXISTS_REPLACE)) {
          $form_state->setValue('csvupload', $destination);
        }
        else {
          $form_state->setErrorByName('csvimport', t('Unable to copy upload file to @dest', ['@dest' => $destination]));
        }
      }
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $batch = [
      'title'            => $this->t('Importing CSV ...'),
      'operations'       => [],
      'init_message'     => $this->t('Importing data'),
      'progress_message' => $this->t('Processed @current out of @total.'),
      'error_message'    => $this->t('An error occurred during processing'),
      'finished'         => '\Drupal\pl_topic8task37\Batch\CsvImportBatch::csvimportImportFinished',
    ];

    if ($csvupload = $form_state->getValue('csvupload')) {
      
      if ($handle = fopen($csvupload, 'r')) {
        $batch['operations'][] = [
          '\Drupal\topic8task37\Batch\CsvImportBatch::csvimportRememberFilename',
          [$csvupload],
        ];
        while ($line = fgetcsv($handle, 4096)) {
          $batch['operations'][] = [
            '\Drupal\topic8task37\Batch\CsvImportBatch::csvimportImportLine',
            [array_map('base64_encode', $line)],
          ];
        }
        fclose($handle);
      }
    }
    batch_set($batch);
  }
}
