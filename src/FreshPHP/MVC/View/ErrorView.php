<?php

namespace FreshPHP\MVC\View;

use FreshPHP\MVC\View\Init\AbstractView;

class ErrorView extends AbstractView {

    public function render() {
        $this->loadFile("error.php");
    }

} 