<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{slug}', [HomeController::class, 'single'])->name('product.single');


/*
 * Chamei o namespace completo do CategoryController, pois estava dando conflito com CategoryController da pasta 'admin'
 */
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.single');


/*
 * Chamei o namespace completo do StoreController, pois estava dando conflito com StoreController da pasta 'admin'
 */
Route::get('/store/{slug}', [App\Http\Controllers\StoreController::class, 'index'])->name('store.single');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::get('remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

/*
 * Essa rota tem que ficar fora do 'Auth' para trabalhar com notificações do Pagseguro
 */

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::post('/notification', [CheckoutController::class, 'notification'])->name('notification');
});


/*
 * Protegendo as rotas para serem acessadas a partir de uma sessão válida
 */
Route::group(['middleware' => ['auth']], function () {

    /*
     * Para finalizar a compra, é necessário que esteja logado, pois precisamos da identificação do comprador 
     */
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    });



    /*
     * Rota para listar os pedidos do usuário na parte pública, 
     * mas que precisa estar logado 
     */
    Route::get('my-orders', [UserOrderController::class, 'index'])->name('user.orders');



    /*
     * Protegendo as rotas para serem acessadas apenas por user com permissão ROLE_OWNER
     */
    Route::group(['middleware' => ['access.control.store.admin']], function () {


        /*
         * Tornando o Controller um recurso
         * Para conferir todas as rotas criadas, basta rodar o comando 'php artisan route:list'
         * 
         * Obs.: o name->('admin.') é para setar o alias para as rotas. Ex.: admin.products.index
         */
        Route::prefix('admin')->name('admin.')->group(function () {

            Route::resource('stores', StoreController::class);
            Route::resource('products', ProductController::class);
            Route::resource('categories', CategoryController::class);

            Route::post('photos/remove/', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');

            Route::get('orders/my', [OrdersController::class, 'index'])->name('orders.my');

            Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
            Route::get('notifications/mark-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark.All.Read');
            Route::get('notifications/mark-single/{notification}', [NotificationController::class, 'markSingleRead'])->name('notifications.mark.single.read');
        });
    });
});



Route::get('not', function() {

//    $user = App\Models\User::find(1);
//    $user->notify(new \App\Notifications\StoreReceiveNewOrder());
//    
//    return $user->notifications;
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
