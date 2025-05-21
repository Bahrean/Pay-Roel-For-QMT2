<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CfoController;

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

    Route::post('/ceo/store', [AdminController::class, 'AdminStore'])->name(
    'ceo.store'
    );

    Route::get('/ceo/showmember', [
        AdminController::class,
        'AdminShowMember',
    ])->name('ceo.showregisteredemployee');

    Route::get('/ceo/showallemployeeforpayrole', [
        AdminController::class,
        'Adminshowallemployeeforpayrole',
    ])->name('ceo.showallemployeeforpayrole');


    Route::get('/ceo/editmember{id}', [
        AdminController::class,
        'AdminEditMember',
    ])->name('ceo.editmember');


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
Route::get('/Cfoview', [FirebaseController::class, 'index'])->name('Cfo.index');


Route::get('/Cfo/{id}/edit', [FirebaseController::class, 'edit'])->name('Cfo.edit');
Route::put('/Cfo/{id}', [FirebaseController::class, 'update'])->name('Cfo.update');
Route::delete('/Cfo/{id}', [FirebaseController::class, 'destroy'])->name('Cfo.destroy');


});

Route::middleware(['auth', 'role:cfo'])->group(function () {
    Route::get('/cfo/dashboard', [
        CfoController::class,
        'CfoDashboard',
    ])->name('collagedean.dashboard');

    Route::get('/cfo/showallemployeeforpayrole', [
        CfoController::class,
        'Adminshowallemployeeforpayrole',
    ])->name('cfo.showallemployeeforpayrole');

    Route::get('/cfo/editmember{id}', [
        CfoController::class,
        'CfoEditMember',
    ])->name('cfo.editmember');

    Route::post('/cfo/calculatepayrole', [CfoController::class, 'Calculatepayrole'])->name(
    'cfo.calculatepayrole'
    );

    Route::post('/cfo/calculateearnedsalary', [CfoController::class, 'Calculateearnedsalary'])->name(
    'cfo.calculateearnedsalary'
    );

    Route::get('/cfo/profile', [
        CfoController::class,
        'CfoProfile',
    ])->name('collagedean.profile');
    Route::get('/cfo/chat', [
        CfoController::class,
        'CfoChat',
    ])->name('collagedean.chat');
    Route::get('/cfo/logout', [
        CfoController::class,
        'CfoLogout',
    ])->name('collagedean.logout');
    Route::post('/cfo/profile/store', [
        CfoController::class,
        'CfoProfileStore',
    ])->name('collagedean.profile.store');
    Route::get('/cfo/change/password', [
        CfoController::class,
        'CfoChangePassword',
    ])->name('collagedean.change.password');
    Route::post('/cfo/update/password', [
        CfoController::class,
        'CfoUpdatePassword',
    ])->name('collagedean.update.password');
    Route::get('/cfo/showmembers', [
        CfoController::class,
        'CfoShowMember',
    ])->name('collegedean.showmembers');

    Route::get('/cfo/showmembers', [
        CfoController::class,
        'CfoShowMember',
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
