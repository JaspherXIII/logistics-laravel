<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryreceiptController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PicklistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceivestockController;
use App\Http\Controllers\ReturnlistController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['middleware' => 'PreventBack'])->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin', 'PreventBack']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('update-profile-info', [AdminController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture', [AdminController::class, 'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');


    Route::resource('accounts', AccountController::class);
    Route::get('/getAccounts', [AccountController::class, 'getAccounts'])->name('accounts.getAccounts');
    Route::get('/getTrashedAccounts', [AccountController::class, 'getTrashedAccounts'])->name('accounts.getTrashedAccounts');
    Route::get('account-trashed', [AccountController::class, 'trashed'])->name('accountTrashed');
    Route::get('account-restore/{user}', [AccountController::class, 'restore'])->name('accountRestore');
    Route::get('account-delete/{user}', [AccountController::class, 'forceDelete'])->name('accountforceDelete');
    Route::resource('suppliers', SupplierController::class);
    Route::get('/getSuppliers', [SupplierController::class, 'getSuppliers'])->name('suppliers.getSuppliers');
    Route::get('/suppliers/getSupplierDetails', [SupplierController::class, 'getSupplierDetails'])->name('suppliers.getSupplierDetails');

    Route::resource('products', ProductController::class);
    Route::get('/getProducts', [ProductController::class, 'getProducts'])->name('products.getProducts');
    Route::post('/updateTable', [ProductController::class, 'updateTable'])->name('products.updateTable');

    

    Route::resource('orders', OrderController::class);
    Route::get('orderForm', [OrderController::class, 'orderForm'])->name('orders.orderForm');
    Route::get('/getOrders', [OrderController::class, 'getOrders'])->name('orders.getOrders');
    Route::get('orderView', [OrderController::class, 'orderView'])->name('orders.orderView');
    Route::get('orderReceived', [OrderController::class, 'orderReceived'])->name('orders.orderReceived');
    Route::get('/orders/update-status/{id}/{status}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('addresses', AddressController::class);
    Route::get('/getAddresses', [AddressController::class, 'getAddresses'])->name('addresses.getAddresses');
    Route::get('/getTop3Orders', [OrderController::class, 'getTop3Orders'])->name('orders.getTop3Orders');

    Route::resource('receivedstocks', ReceivestockController::class);
    Route::get('/getReceivedstocks', [ReceivestockController::class, 'getReceivedstocks'])->name('receivedstocks.getReceivedstocks');
   
    Route::resource('inventories', InventoryController::class);
    Route::get('/getInventories', [InventoryController::class, 'getInventories'])->name('inventories.getInventories');
    Route::post('inventories/bulk-update', [InventoryController::class, 'bulkUpdate'])->name('inventories.bulkUpdate');

    Route::get('/inventories/{productId}', [InventoryController::class, 'getProductsByinventory'])->name('inventories.byInventory');

    Route::resource('picklists', PicklistController::class);
    Route::get('picklistForm', [PicklistController::class, 'picklistForm'])->name('picklists.picklistForm');
    Route::get('/getPicklists', [PicklistController::class, 'getPicklists'])->name('picklists.getPicklists');
    Route::get('picklistView', [PicklistController::class, 'picklistView'])->name('picklists.picklistView');
  
    Route::resource('deliveryreceipts', DeliveryreceiptController::class);
    Route::get('deliveryreceiptForm', [DeliveryreceiptController::class, 'deliveryreceiptForm'])->name('deliveryreceipts.deliveryreceiptForm');
    Route::get('/getDeliveryreceipts', [DeliveryreceiptController::class, 'getDeliveryreceipts'])->name('deliveryreceipts.getDeliveryreceipts');

    Route::resource('returns', ReturnlistController::class);
    Route::get('returnForm', [ReturnlistController::class, 'returnForm'])->name('returns.returnForm');
    Route::get('/getReturns', [ReturnlistController::class, 'getReturns'])->name('returns.getReturns');
    Route::get('returnView', [ReturnlistController::class, 'returnView'])->name('returns.returnView');
    Route::get('/returns/update-status/{id}/{status}', [ReturnlistController::class, 'updateStatus'])->name('returns.updateStatus');
});


Route::group(['prefix' => 'user', 'middleware' => ['auth', 'isUser', 'PreventBack']], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
    Route::get('schedule', [UserController::class, 'schedule'])->name('user.schedule');
    Route::post('getSchedules', [UserController::class, 'getSchedules'])->name('user.getSchedules');
    Route::post('update-profile-info', [UserController::class, 'updateInfo'])->name('userUpdateInfo');
    Route::post('change-profile-picture', [UserController::class, 'updatePicture'])->name('userPictureUpdate');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('userChangePassword');
    Route::post('studentupdate-profile-info', [UserController::class, 'studentupdateInfo'])->name('studentUpdateInfo');

    Route::resource('account', AccountController::class);
    Route::get('/getAccounts', [AccountController::class, 'getAccounts'])->name('accounts.getAccounts');
    Route::get('/getTrashedAccounts', [AccountController::class, 'getTrashedAccounts'])->name('accounts.getTrashedAccounts');
    Route::get('account-trashed', [AccountController::class, 'trashed'])->name('accountTrashed');
    Route::get('account-restore/{user}', [AccountController::class, 'restore'])->name('accountRestore');
    Route::get('account-delete/{user}', [AccountController::class, 'forceDelete'])->name('accountforceDelete');
   
    Route::resource('supplier', SupplierController::class);
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('user/suppliers.index');
    Route::get('/getSuppliers', [SupplierController::class, 'getSuppliers'])->name('user/suppliers.getSuppliers');
    Route::get('/suppliers/getSupplierDetails', [SupplierController::class, 'getSupplierDetails'])->name('user/suppliers.getSupplierDetails');

    Route::resource('product', ProductController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('user/products.index');
    Route::get('/getProducts', [ProductController::class, 'getProducts'])->name('user/products.getProducts');
    Route::post('/updateTable', [ProductController::class, 'updateTable'])->name('user/products.updateTable');

    

    Route::resource('order', OrderController::class);
    Route::get('/orders', [OrderController::class, 'index'])->name('user/orders.index');
    
    Route::get('orderReceived', [OrderController::class, 'orderReceived'])->name('user/orders.orderReceived');

    Route::get('/getOrders', [OrderController::class, 'getOrders'])->name('user/orders.getOrders');
    Route::get('orderView', [OrderController::class, 'orderView'])->name('user/orders.orderView');
   
    Route::get('/getAddresses', [AddressController::class, 'getAddresses'])->name('user/addresses.getAddresses');

    Route::resource('receivedstock', ReceivestockController::class);
    Route::get('/receivedstocks', [ReceivestockController::class, 'index'])->name('user/receivedstocks.index');
    Route::get('/getReceivedstocks', [ReceivestockController::class, 'getReceivedstocks'])->name('user/receivedstocks.getReceivedstocks');
   
    Route::resource('inventory', InventoryController::class);
    Route::get('/inventories', [InventoryController::class, 'index'])->name('user/inventories.index');
    Route::get('/getInventories', [InventoryController::class, 'getInventories'])->name('user/inventories.getInventories');

    Route::resource('picklist', PicklistController::class);
    Route::get('/picklists', [PicklistController::class, 'index'])->name('user/picklists.index');
    Route::get('/getPicklists', [PicklistController::class, 'getPicklists'])->name('user/picklists.getPicklists');
    Route::get('picklistView', [PicklistController::class, 'picklistView'])->name('user/picklists.picklistView');
  
    Route::resource('deliveryreceipt', DeliveryreceiptController::class);
    Route::get('/deliveryreceipts', [DeliveryreceiptController::class, 'index'])->name('user/deliveryreceipts.index');
    Route::get('/getDeliveryreceipts', [DeliveryreceiptController::class, 'getDeliveryreceipts'])->name('user/deliveryreceipts.getDeliveryreceipts');
    Route::get('deliveryreceiptForm', [DeliveryreceiptController::class, 'deliveryreceiptForm'])->name('user/deliveryreceipts.deliveryreceiptForm');

    Route::resource('return', ReturnlistController::class);
    Route::get('/returns', [ReturnlistController::class, 'index'])->name('user/returns.index');
    Route::get('/getReturns', [ReturnlistController::class, 'getReturns'])->name('user/returns.getReturns');
    Route::get('returnView', [ReturnlistController::class, 'returnView'])->name('user/returns.returnView');
    Route::get('/returns/update-status/{id}/{status}', [ReturnlistController::class, 'updateStatus'])->name('user/returns.updateStatus');
});
