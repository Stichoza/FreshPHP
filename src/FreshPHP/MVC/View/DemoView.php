<?php

namespace FreshPHP\MVC\View;

use FreshPHP\MVC\View\Init\AbstractView;

class DemoView extends AbstractView {

    public function render() {
        $this->loadFile("components/head.php");
        $this->loadFile("demo.html");
        $this->loadFile("components/foot.php");
    }

} 