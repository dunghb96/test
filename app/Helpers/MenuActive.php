<?php

namespace App\Helpers;


class MenuActive
{
    public $listActive = [
        // Master Menu
        'admin.home' => [
            'parent' => 'bill'
        ],
        'admin.bill.edit' => [
            'parent' => 'customer_register',
        ],
        'admin.customer_register' => [
            'parent' => 'customer_register',
        ],
        'admin.customer_register.confirm' => [
            'parent' => 'customer_register',
        ],
        'admin.customer_register.store' => [
            'parent' => 'customer_register',
        ],
        'admin.customer_register.show_confirm' => [
            'parent' => 'customer_register',
        ],
        'admin.user.index' => [
            'parent' => 'user'
        ],
        'admin.user.create' => [
            'parent' => 'user'
        ],
        'admin.user.edit' => [
            'parent' => 'user'
        ]
    ];

    public function getActiveSidebar()
    {
        $currentRoute = request()->route()->getName();

        if (isset($this->listActive[$currentRoute])) {
            return $this->listActive[$currentRoute];
        }

        return null;
    }
}
