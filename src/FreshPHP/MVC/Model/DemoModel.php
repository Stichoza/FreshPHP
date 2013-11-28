<?php

namespace FreshPHP\MVC\Model;

use FreshPHP\MVC\Model\Init\AbstractModel;

class DemoModel extends AbstractModel {

    public function getDemoText() {
        return $this->sql->get("demo_table_from_db");
    }

    public function getPageContent() {
        return "Demo Page :>";
    }

} 