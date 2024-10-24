<?php

class DashboardController {

    static public function render() {
        $data = [
            'title' => 'TiendaOnline - Dashboard'
        ];
        TemplateController::render('./views/dashboard.php', './views/layout/sidebar.php', $data);
    }
    
}
