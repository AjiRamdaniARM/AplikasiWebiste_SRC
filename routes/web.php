<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DirectiveController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GdDrive;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocationEventController;
use App\Http\Controllers\OrganizedController;
use App\Http\Controllers\Participant\Certificate;
use App\Http\Controllers\Participant\InvoiceController as ParticipantInvoiceController;
use App\Http\Controllers\Participant\JadwalController;
use App\Http\Controllers\Participant\RaceController as ParticipantRaceController;
use App\Http\Controllers\Participant\TeamController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\voucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// certificate user
Route::get('certificate', [Certificate::class, 'certificate']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('user', UserController::class);
            Route::resource('contact-me', ContactMeController::class)->except(['create', 'show']);
            Route::resource('location-event', LocationEventController::class)->except(['create', 'edit', 'show']);
            Route::resource('organized', OrganizedController::class)->except(['create', 'edit', 'show']);
            Route::resource('category', CategoryController::class);
            Route::resource('faq', FaqController::class)->except(['create', 'show']);
            Route::resource('directive', DirectiveController::class)->except(['create', 'show']);
            Route::resource('race', RaceController::class);
            Route::resource('race.participant', ParticipantController::class)->only(['index', 'create']);
            Route::resource('invoice', InvoiceController::class)->except(['edit', 'destroy']);

        });

        // participant
        Route::prefix('participant')->name('participant.')->group(function () {
            Route::get('race', [ParticipantRaceController::class, 'index'])->name('race.index');
            Route::post('race', [ParticipantRaceController::class, 'store'])->name('race.store');
            Route::get('invoice', [ParticipantInvoiceController::class, 'index'])->name('invoice.index');
            Route::get('invoice/{id}', [ParticipantInvoiceController::class, 'show'])->name('invoice.show');
            Route::post('invoice/{id}', [ParticipantInvoiceController::class, 'store'])->name('invoice.store');
            Route::resource('invoice.team', TeamController::class)->only(['index', 'store']);

        });
        // end participant
    });

    // voucher route
    Route::post('dashboard/voucher', [voucherController::class, 'store']);
    Route::post('payment/kode/{id}', [PaymentController::class, 'diskon'])->name('voucher.post');

    Route::get('particpants/upload/project/{id}', [GdDrive::class, 'getUpload']);
    Route::post('particpants/upload/{id}', [GdDrive::class, 'Upload']);
    Route::post('particpants/upload/project/{id}', [GdDrive::class, 'UpDrive']);
    Route::get('notif/{id}', [DashboardController::class, 'notifDelete']);
    Route::post('/dashboard/seleksi/{id_peserta}', [DashboardController::class, 'seleksi']);
    Route::get('/dashboard/upload', [DashboardController::class, 'uploadProject'])->name('upload.index');

    Route::get('participant/admin', [PesertaController::class, 'adminParticipants'])->name('participant.show.admin');
    Route::get('participants', [ParticipantController::class, 'show'])->name('participant.show.index');
    Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('particpants/{id}', [InvoiceController::class, 'participants'])->name('particpants.show');
    Route::post('/dashboard/participant/invoice/{id}', [PaymentController::class, 'pay2'])->name('participant.invoice.store');
    Route::get('detail/{id}', [DetailController::class, 'index']);
    Route::post('detail/{id}', [DetailController::class, 'create']);
    Route::post('detail/online/{id}', [DetailController::class, 'createOnline']);
    // === payment router === //
    Route::get('payment/{id}', [DetailController::class, 'payment']);
    Route::post('payment/{id}/{name}', [PaymentController::class, 'pay']);
    Route::post('payment/{id}', [PaymentController::class, 'participants'])->name('payment.participants');
    Route::post('invoiceParticpants/{id}', [PaymentController::class, 'participants2'])->name('invoice.participants');
    Route::post('particpants/{id_peserta}', [ParticipantController::class, 'editParticipants']);
    Route::get('particpants/admin/delete/{id_peserta}', [ParticipantController::class, 'delete']);

    // == route page peserta admin == //
    Route::get('/particpants/admin/{id}', [ParticipantController::class, 'peserta']);
    Route::post('/utilities/upload', [UtilitiesController::class, 'upload']);
    Route::delete('/utilities/reverse', [UtilitiesController::class, 'reverse']);
});

Route::get('/{slug}', [HomeController::class, 'show']);
