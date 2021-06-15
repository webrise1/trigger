<?php
namespace webrise1\trigger\models;
class Menu {
    public static function getAdminMenu($label='Триггеры'){
        return
            [
                'label' => $label, 'icon' => 'microchip','url' => ['/admin/trigger/default']
            ];
    }
}