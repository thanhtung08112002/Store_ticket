<?php

//client

use App\Http\Controllers\Client\HomeController;


//admin
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AirplaneBrandController;
use App\Http\Controllers\Admin\AirplaneController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Client\CheckoutController;
use Illuminate\Support\Facades\Route;


Route::match(['get', 'post'], 'auth/login-admin', [AuthController::class, 'loginForm'])->name('login');
Route::match(['get', 'post'], 'auth/register-admin', [AuthController::class, 'registerForm'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    $controller_path = 'App\Http\Controllers';

    // Main Page Route
    Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics')->middleware('role');

    //Hãng bay
    Route::group(['prefix' => 'airplane-brand', 'as' => 'airplane_brand.', 'middleware' => 'role'], function () {
        Route::get('/', [AirplaneBrandController::class, 'index'])->name('index');
        Route::get('/form-add', [AirplaneBrandController::class, 'formAdd'])->name('formAdd');
        Route::post('/add', [AirplaneBrandController::class, 'add'])->name('add');

        Route::get('/form-edit/{id}', [AirplaneBrandController::class, 'formEdit'])->name('formEdit');
        Route::post('/edit', [AirplaneBrandController::class, 'edit'])->name('edit');

        Route::get('delete/{id}', [AirplaneBrandController::class, 'remove'])->name('remove');
    });

    //Máy bay
    Route::group(['prefix' => 'airplane', 'as' => 'airplane.', 'middleware' => 'role'], function () {
        Route::get('/', [AirplaneController::class, 'index'])->name('index');
        Route::get('/form-add', [AirplaneController::class, 'formAdd'])->name('formAdd');
        Route::post('/add', [AirplaneController::class, 'add'])->name('add');

        Route::get('/form-edit/{id}', [AirplaneController::class, 'formEdit'])->name('formEdit');
        Route::post('/edit', [AirplaneController::class, 'edit'])->name('edit');

        Route::get('delete/{id}', [AirplaneController::class, 'remove'])->name('remove');
    });

    //Chuyến bay
    Route::group(['prefix' => 'flight', 'as' => 'flight.', 'middleware' => 'role'], function () {
        Route::get('/', [FlightController::class, 'index'])->name('index');
        Route::get('/form-add', [FlightController::class, 'formAdd'])->name('formAdd');
        Route::post('/add', [FlightController::class, 'add'])->name('add');
        Route::get('/form-edit/{id}', [FlightController::class, 'formEdit'])->name('formEdit');
        Route::put('/edit', [FlightController::class, 'edit'])->name('edit');
        Route::get('delete/{id}', [FlightController::class, 'remove'])->name('remove');
    });

    //Thông tin đặt vé bay
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/details/{id}', [OrderController::class, 'details'])->name('details');
        Route::put('/update', [OrderController::class, 'update'])->name('update');
        Route::put('/cancel', [OrderController::class, 'cancel'])->name('cancel');


    });

    //Vé bay
    Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
        Route::get('pending', [TicketController::class, 'pending'])->name('pending');
        Route::get('success', [TicketController::class, 'success'])->name('success');
        Route::get('cancel', [TicketController::class, 'cancel'])->name('cancel');
    });



    // layout
    Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
    Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
    Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
    Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
    Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

    // pages
    Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
    Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
    Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
    Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

    // authentication
    Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

    // cards
    Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

    // User Interface
    Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
    Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
    Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
    Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
    Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
    Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
    Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
    Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
    Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
    Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
    Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
    Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
    Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
    Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
    Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
    Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
    Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
    Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
    Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

    // extended ui
    Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
    Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

    // icons
    Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

    // form elements
    Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
    Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

    // form layouts
    Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
    Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

    // tables
    Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');
});


Route::group(['as' => 'client.'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('index');
        Route::post('/payment', [CheckoutController::class, 'pay'])->name('pay');
    });
});

Route::group(['as' => 'ajax.', 'prefix' => 'ajax'], function () {
    Route::post('details', [HomeController::class, 'details'])->name('details');
    Route::get('/checkDiscount/{code}', [CheckoutController::class, 'checkDiscount']);
    Route::get('/paymentVNPay/{params?}', [CheckoutController::class, 'paymentVNPay'])->name('paymentVNPay');
});
