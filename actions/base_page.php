<?php

  class BasePage {
    protected function notFound() {
      require_once './view/not_found.php';
    }
  }
