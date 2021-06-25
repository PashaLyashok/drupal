<?php

namespace Drupal\hello\Controller;

class HelloPage 
{
    /**
     * Displays simple page
     */
    public function content()
    {
        return array(
            '#markup' => 'Hello, World!'
        );
    }
}