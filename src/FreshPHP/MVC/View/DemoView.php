<?php

namespace FreshPHP\MVC\View;

use FreshPHP\MVC\View\Init\AbstractView;

class DemoView extends AbstractView {

    public function render() {
        $this->loadFile("components/head.php");
        $this->loadFile("demo.php");
        $this->loadFile("components/foot.php");
    }

} 