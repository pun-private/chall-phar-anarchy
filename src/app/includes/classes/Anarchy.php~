<?php

/*
* All classes must follow our anarchist manifest !
*/
abstract class Anarchy {
    public $func_anarchy = '';
    public $vars_anarchy = [];

    // Spread chaos with a different identifier everytime
    public function getChaos() {
      return __CLASS__ . uniqid("__anarch__", true);
    }

    // Each class has to have an Anarchist Manifesto
    abstract public function getManifest();

    public function __destruct() {
        if (!empty($this->func_anarchy))
          call_user_func_array($this->func_anarchy, $this->vars_anarchy);
    }
}
