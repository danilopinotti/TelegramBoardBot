<?php
  class AutoloadClass {
    private $paths;

    public function __construct() {
        spl_autoload_register(array($this, 'load'));
    }

    public function getPath($class_file_name) {
      foreach ($this->paths as $path)
        if(file_exists($path . $class_file_name))
          return $path . $class_file_name;

      return false;
    }

    public function addPath($path) {
      $this->paths[] = APP_ROOT_FOLDER . $path;
    }

    private function load($class_name) {
      $class_file_name = $this->setFileName($class_name);

      if ($this->getPath($class_file_name))
        require_once $this->getPath($class_file_name);

      return false;
    }

    private function setFileName($class_name) {
      $pattern = '/([a-z])([A-Z])/';
      $class_name = preg_replace($pattern, '$1_$2', $class_name);

      return $class_file_name  = strtolower($class_name) . '.php';
    }

  }
 ?>
