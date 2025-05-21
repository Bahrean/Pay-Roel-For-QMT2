<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgriExpertController;

use App\Http\ControostController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\SendToFarmerController;
use App\Http\Controllers\SendToExpertController;
use App\Http\Controllers\SendToBuyerController;
use App\Http\Controllers\BuyerController;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Users;

use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\FirebaseUserController;

use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/auth.php';


Route::prefix('buyers')->group(function () {
    Route::get('/', [BuyerController::class, 'index'])->name('buyers.index');
    Route::post('/sync', [BuyerController::class, 'sync'])->name('buyers.sync');
    Route::get('/{buyer}', [BuyerController::class, 'show'])->name('buyers.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/chat', Index::class)->name('chat.index');
    Route::get('/chat/{query}', Chat::class)->name('chat');

    Route::get('/users', Users::class)->name('users');

    Route::patch('/posts/{post}/{action}', [
        PostController::class,
        'updateFeedback',
    ]);

});

Route::middleware(['auth', 'role:CEO'])->group(function () {
    Route::get('/ceo/register_employee', [
    AdminController::class,
    'CeoAddMember',
    ])->name('ceo.register_employee');




    Route::get('/admin/dashboard', [
        AdminController::class,
        'AdminDashboard',
    ])->name('admin.dashboard');
    Route::get('/admin/profile', [
        AdminController::class,
        'AdminProfile',
    ])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name(
        'admin.logout'
    );
    Route::post('/admin/profile/store', [
        AdminController::class,
        'AdminProfileStore',
    ])->name('admin.profile.store');
    Route::get('/admin/change/password', [
        AdminController::class,
        'AdminChangePassword',
    ])->name('admin.change.password');
    Route::get('/admin/chat', [AdminController::class, 'AdminChat'])->name(
        'admin.chat'
    );
    Route::get('/admin/posts', [AdminController::class, 'AdminPosts'])->name(
        'admin.posts'
    );
    Route::post('/admin/update/password', [
        AdminController::class,
        'AdminUpdatePassword',
    ])->name('admin.update.password');
    Route::get('/admin/addmember', [
        AdminController::class,
        'AdminAddMember',
    ])->name('admin.addmember');
    Route::get('/admin/showmember', [
        AdminController::class,
        'AdminShowMember',
    ])->name('admin.showmember');
    Route::post('/admin/store', [AdminController::class, 'AdminStore'])->name(
        'admin.store'
    );
    Route::get('/admin/editmember{id}', [
        AdminController::class,
        'AdminEditMember',
    ])->name('admin.editmember');
    Route::post('/admin/updatemember', [
        AdminController::class,
        'AdminUpdateMember',
    ])->name('admin.updatemember');
    Route::get('/admin/deletemember{id}', [
        AdminController::class,
        'AdminDeleteMember',
    ])->name('admin.deletemember');




    Route::post('/admin/statuschange{id}', [
        AdminController::class,
        'AdminStatusChange',
    ])->name('admin.statuschange');






    Route::get('/admin/addagricultureexpert', [
        AdminController::class,
        'AdminAddAgricultureExpert',
    ])->name('admin.addagricultureexpert');


Route::get('/form', [FirebaseController::class, 'showForm'])->name('firebase.form');

Route::post('/form', [FirebaseController::class, 'submitForm'])->name('firebase.store');
Route::get('/agriexpertview', [FirebaseController::class, 'index'])->name('agriexpert.index');


Route::get('/agriexpert/{id}/edit', [FirebaseController::class, 'edit'])->name('agriexpert.edit');
Route::put('/agriexpert/{id}', [FirebaseController::class, 'update'])->name('agriexpert.update');
Route::delete('/agriexpert/{id}', [FirebaseController::class, 'destroy'])->name('agriexpert.destroy');


Route::prefix('market-price')->group(function () {
    Route::get('/create', [MarketPriceController::class, 'create'])->name('market-price.create');
    Route::post('/store', [MarketPriceController::class, 'store'])->name('market-price.store');
    Route::get('/', [MarketPriceController::class, 'index'])->name('market-price.index');

    Route::get('/{id}/edit', [MarketPriceController::class, 'edit'])->name('market-price.edit');
    Route::put('/{id}', [MarketPriceController::class, 'update'])->name('market-price.update');
    Route::delete('/{id}', [MarketPriceController::class, 'destroy'])->name('market-price.destroy');

});



Route::prefix('firebase/users')->group(function () {
    Route::get('/', [FirebaseUserController::class, 'index'])->name('firebase.users.index');
    Route::get('/sync', [FirebaseUserController::class, 'sync'])->name('firebase.users.sync');
});


Route::prefix('send-to-farmer')->group(function () {
    Route::get('/create', [SendToFarmerController::class, 'create'])->name('send_to_farmer.create');
    Route::post('/store', [SendToFarmerController::class, 'store'])->name('send_to_farmer.store');
    Route::get('/', [SendToFarmerController::class, 'index'])->name('send_to_farmer.index');

    Route::get('/{id}/edit', [SendToFarmerController::class, 'edit'])->name('send_to_farmer.edit');
    Route::put('/{id}', [SendToFarmerController::class, 'update'])->name('send_to_farmer.update');
    Route::delete('/{id}', [SendToFarmerController::class, 'destroy'])->name('send_to_farmer.destroy');

});

Route::prefix('send-to-expert')->group(function () {
    Route::get('/create', [SendToExpertController::class, 'create'])->name('send_to_expert.create');
    Route::post('/store', [SendToExpertController::class, 'store'])->name('send_to_expert.store');
    Route::get('/', [SendToExpertController::class, 'index'])->name('send_to_expert.index');

    Route::get('/{id}/edit', [SendToExpertController::class, 'edit'])->name('send_to_expert.edit');
    Route::put('/{id}', [SendToExpertController::class, 'update'])->name('send_to_expert.update');
    Route::delete('/{id}', [SendToExpertController::class, 'destroy'])->name('send_to_expert.destroy');

});

Route::prefix('send-to-buyer')->group(function () {
    Route::get('/create', [SendToBuyerController::class, 'create'])->name('send_to_buyer.create');
    Route::post('/store', [SendToBuyerController::class, 'store'])->name('send_to_buyer.store');
    Route::get('/', [SendToBuyerController::class, 'index'])->name('send_to_buyer.index');

    Route::get('/{id}/edit', [SendToBuyerController::class, 'edit'])->name('send_to_buyer.edit');
    Route::put('/{id}', [SendToBuyerController::class, 'update'])->name('send_to_buyer.update');
    Route::delete('/{id}', [SendToBuyerController::class, 'destroy'])->name('send_to_buyer.destroy');

});

});

Route::middleware(['auth', 'role:cfo'])->group(function () {
    Route::get('/cfo/dashboard', [
        AgriExpertController::class,
        'AgriExpertDashboard',
    ])->name('collagedean.dashboard');
    Route::get('/cfo/profile', [
        AgriExpertController::class,
        'AgriExpertProfile',
    ])->name('collagedean.profile');
    Route::get('/cfo/chat', [
        AgriExpertController::class,
        'AgriExpertChat',
    ])->name('collagedean.chat');
    Route::get('/cfo/logout', [
        AgriExpertController::class,
        'AgriExpertLogout',
    ])->name('collagedean.logout');
    Route::post('/cfo/profile/store', [
        AgriExpertController::class,
        'AgriExpertProfileStore',
    ])->name('collagedean.profile.store');
    Route::get('/cfo/change/password', [
        AgriExpertController::class,
        'AgriExpertChangePassword',
    ])->name('collagedean.change.password');
    Route::post('/cfo/update/password', [
        AgriExpertController::class,
        'AgriExpertUpdatePassword',
    ])->name('collagedean.update.password');
    Route::get('/cfo/showmembers', [
        AgriExpertController::class,
        'AgriExpertShowMember',
    ])->name('collegedean.showmembers');

    Route::get('/cfo/showmembers', [
        AgriExpertController::class,
        'AgriExpertShowMember',
    ])->name('collegedean.showmembers');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});
