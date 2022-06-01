<?php
use App\Models\User;
$listMenus = [
    [
        'title' => '請求書一覧',
        'href' => route('admin.home'),
        'active' => 'bill',
    ],
    [
        'title' => '請求情報登録',
        'href' => route('admin.customer_register'),
        'active' => 'customer_register',
    ]
];

if (Auth::guard('admin')->user()->auth == User::MANAGER_USER) {
    $listMenus = [
        [
            'title' => '請求書一覧',
            'href' => route('admin.home'),
            'active' => 'bill',
        ],
        [
            'title' => '請求情報登録',
            'href' => route('admin.customer_register'),
            'active' => 'customer_register',
        ],
        [
            'title' => 'ユーザー管理',
            'href' => route('admin.user.index'),
            'active' => 'user',
        ]
    ];
}
$menuActive = (new \App\Helpers\MenuActive)->getActiveSidebar();
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu " id="sidenav-menu">
            <div class="nav" id="sub-sidenav">
                @foreach ($listMenus as $row)
                    @php
                        $activeClassParent = isset($row['active']) && isset($menuActive['parent']) && $row['active'] == $menuActive['parent'] ? 'active' : '';
                    @endphp
                    <a href="{{$row['href']}}" class="nav-link {{$activeClassParent != '' ? 'active' : '' }} ">
                        {{$row['title']}}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</div>
