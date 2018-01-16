<?php

  class BasePage {
    protected $getData;
    protected $postData;

    protected function notFound() {
      require_once './view/not_found.php';
    }

    protected function redirect($url) {
      header('location: /?r=' . $url);
    }

    public function process($getData, $postData) {
      $this->getData = $getData;
      $this->postData = $postData;

      if (empty($postData)) {
        $this->get();
      } else {
        $this->post();
      }
    }
  }
