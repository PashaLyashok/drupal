<?php

namespace Drupal\pl_topic8task37;

use Drupal\file\Entity\File;
use Drupal\user\Entity\User;
/**
 * Class UsersBatchImport.
 *
 * @package Drupal\pl_topic8task37.
 */
class UsersBatchImport {
    # Здесь мы будем хранить всю информацию о нашей Batch операции.
  private $batch;

  # FID для CSV файла.
  private $fid;

  # Объект файла.
  private $file;

  # Мы также добавим возможность игнорировать первую строку у csv файла,
  # которая может использоваться для заголовков столбцов.
  # По умолчанию первая линия будет считываться и обрабатываться.
  private $skip_first_line;

  # Разделитель столбцов CSV.
  private $delimiter;

  # Ограничитель поля CSV.
  private $enclosure;

  /**
   * {@inheritdoc}
   */
  public function __construct($fid, $skip_first_line = FALSE, $delimiter = ';', $enclosure = ',', $batch_name = 'Custom CSV import') {
    $this->fid = $fid;
    $this->file = File::load($fid);
    $this->skip_first_line = $skip_first_line;
    $this->delimiter = $delimiter;
    $this->enclosure = $enclosure;
    $this->batch = [
      'title' => $batch_name,
      'finished' => [$this, 'finished'],
      'file' => drupal_get_path('module', 'pl_topic8task37') . '/src/UsersBatchImport.php',
    ];
    $this->parseCSV();
  }

  /**
 * {@inheritdoc}
 * Метод для регистрации нашей batch операции, которую мы подготовили.
 */
  public function setBatch() {
    batch_set($this->batch);
  }

  /**
   * {@inheritdoc}
   * Метод для ручного запуска выполнения batch операций.
   */
  public function processBatch() {
    batch_process();
  }

  /**
   * {@inheritdoc}
   *
   * Метод который будет вызван по окончанию всех batch операций, или в случае
   * возникновения ошибки в процессе.
   */
  public function finished($success, $results, $operations) {
    if ($success) {
      $message = \Drupal::translation()
        ->formatPlural(count($results), 'One post processed.', '@count posts processed.');
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }

  /**
   * {@inheritdoc}
   *
   * В данном методе мы обрабатываем наш CSV строка за строкой, а не грузим
   * весь файл в память, так что данный способ значительно менее затратный
   * и более шустрый.
   *
   * Каждую строку мы получаем в виде массива, а массив передаем в операцию на
   * выполнение.
   */
  public function parseCSV() {
    if (($handle = fopen($this->file->getFileUri(), 'r')) !== FALSE) {
      # Если необходимо пропустить первую строку csv файла, то мы просто в
      # холостую грузим и ничего не делаем с ней.
      if ($this->skip_first_line) {
        fgetcsv($handle, 0, ';');
      }
      while (($data = fgetcsv($handle, 0, ';')) !== FALSE) {
        $this->setOperation($data);
      }
      fclose($handle);
    }
  }

  public function processItem($email, $password, &$context) {
    # Если указан id, значит мы правим ноду а не создаем.
    if (!empty($id)) {
      $user = User::load($id);
    }
    else {
      $user = User::create([
        'email' => $email,
        'password' => $password,
        'status' => 1,
      ])->save();
    }  
    # Записываем результат в общий массив результатов batch операции. По этим
    # данным мы будем выводить кол-во импортированных данных.
    $context['results'][] = $user->id() . ' : ' . $user->label();
    $context['message'] = $user->label();
  }
}