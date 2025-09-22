<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RDVController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicesController;
// use App\Models\Gallery;
// use App\Models\Patient;
// use App\Models\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashMovementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlocPaymentController;
use App\Http\Controllers\EventController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// protected routes
    // Route::get('/dashboard', function () {
    //     return view('dashboard'); // your main page
    // })->name('dashboard');

Route::get('/', function () {
    return view('home');
});

Route::get('/rendez-vous', function () {
    return view('rendezVous');
});

// Route::get('/ajouter-rdv', function () {
//     return view('admin.rdvCreate');
// });

// Route::post('/rendez-vous',[RDVController::class, 'store'])->name('RDVstore');
// Route::post('/ajouter-rdv',[RDVController::class, 'create'])->name('RDV.create');
// Route::get('/rdv/confirmation', function () {
//     return view('rdvConfirmed');
// })->name('rdv.confirmation');

// Route::prefix('admin/rdv')->group(function () {
    // your admin page to list rdvs
    // Route::get('/', [RdvController::class, 'index'])->name('rdv.index');

    // extra routes for actions
//     Route::patch('/{id}/confirm', [RdvController::class, 'confirm'])->name('rdv.confirm');
//     Route::patch('/{id}/cancel', [RdvController::class, 'cancel'])->name('rdv.cancel');
//     Route::get('/calendar', [RDVController::class, 'calendar'])->name('rdv.calendar'); // calendar page
//     Route::get('/calendar/data', [RDVController::class, 'calendarData'])->name('rdv.calendar.data'); // JSON data
// });
// Route::get('gallery/upload',[RDVController::class,'editPicture']);

Route::get('/services', function ()  {
    return view('services');
});



// Route::prefix('admin')->group(function () {
//     Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
//     Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
//     Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
//     // Route::get('/galleries/{id}', [GalleryController::class, 'show'])->name('galleries.show');
//     // Route::get('/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
//     // Route::put('/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
//     Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
// });
Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');
// Route::get('galleries', function () {
// return view('admin.galleries.create');
// });

// Route::get('/test-image', [GalleryController::class, 'testImage']);
// Route::post('/admin/gallery/upload', [GalleryController::class, 'store']);
// Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
// Route::PUT('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
// Route::get('/patients/create', function  () {return view('patients.create');})->name('patients.create');
// Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
// Route::post('/patient/upload', [PatientController::class, 'store'])->name('patient.store');
// Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
// Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');




// Route::prefix('/payments')->group( function () {
// Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
// Route::POST('/store', [PaymentController::class, 'store'])->name('payment.store');
// Route::GET('', [PaymentController::class, 'index'])->name('payments.index');
// Route::DELETE('/{id}', [PaymentController::class, 'destroy'])->name('payment.delete');
// Route::GET('/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
// Route::PUT('/{id}', [PaymentController::class, 'update'])->name('payment.update');
// // Route::PUT('/{id}', [PaymentController::class, 'show'])->name('payment.show');
// }
// );




// Route::prefix('/expenses')->group( function () {
// Route::get('/create', [ExpenseController::class, 'create'])->name('expense.create');
// Route::POST('/store', [ExpenseController::class, 'store'])->name('expense.store');
// Route::GET('', [ExpenseController::class, 'index'])->name('expenses.index');
// Route::DELETE('/{id}', [ExpenseController::class, 'destroy'])->name('expense.delete');
// Route::GET('/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
// Route::PUT('/{id}', [ExpenseController::class, 'update'])->name('expense.update');
// }
// );

// Route::get('/dashboard',[Dashboard::class,'index'])->name('dashboard');





Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Route::get('/patients/search', [App\Http\Controllers\PatientController::class, 'search'])
//      ->name('patients.search');


// ======= ADMIN ONLY =======
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',[Dashboard::class,'index'])->name('dashboard');

    Route::prefix('/expenses')->group(function () {
        Route::get('/create', [ExpenseController::class, 'create'])->name('expense.create');
        Route::post('/store', [ExpenseController::class, 'store'])->name('expense.store');
        Route::get('', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::delete('/{id}', [ExpenseController::class, 'destroy'])->name('expense.delete');
        Route::get('/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
        Route::put('/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    });

        Route::get('/cash-movements', [ CashMovementController::class, 'index'])->name('cash_movements.index');

    // Route::prefix('/payments')->group(function () {
    //     Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
    //     Route::post('/store', [PaymentController::class, 'store'])->name('payment.store');
    //     Route::get('', [PaymentController::class, 'index'])->name('payments.index');
    //     Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('payment.delete');
    //     Route::get('/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    //     Route::put('/{id}', [PaymentController::class, 'update'])->name('payment.update');
    // });
    Route::prefix('/users')->group( function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('', [UserController::class, 'store'])->name('users.store');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');

    });

Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');



Route::prefix('bloc-payments')->name('bloc-payments.')->group(function () {
    // List all bloc payments
    Route::get('/', [BlocPaymentController::class, 'index'])->name('index');



    // Edit existing bloc payment
    Route::get('/{blocPayment}/edit', [BlocPaymentController::class, 'edit'])->name('edit');

    // Update existing bloc payment
    Route::put('/{blocPayment}', [BlocPaymentController::class, 'update'])->name('update');

    // Delete bloc payment
    Route::delete('/{blocPayment}', [BlocPaymentController::class, 'destroy'])->name('destroy');
});

});

// ======= ADMIN + ASSISTANT =======
Route::middleware(['auth', 'role:admin,assistant'])->group(function () {
    // RDVs
    Route::prefix('admin/rdv')->group(function () {
        Route::get('/', [RdvController::class, 'index'])->name('rdv.index');
        Route::patch('/{id}/confirm', [RdvController::class, 'confirm'])->name('rdv.confirm');
        Route::patch('/{id}/cancel', [RdvController::class, 'cancel'])->name('rdv.cancel');
        Route::get('/calendar', [RDVController::class, 'calendar'])->name('rdv.calendar');
        Route::get('/calendar/data', [RDVController::class, 'calendarData'])->name('rdv.calendar.data');
    });

    // Patients
    Route::prefix('/patients')->group(function () {
    Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::PUT('/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::get('/create', function  () {return view('patients.create');})->name('patients.create');
    Route::get('', [PatientController::class, 'index'])->name('patients.index');
    Route::post('/upload', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::get('/{patient}', [PatientController::class, 'show'])->name('patients.show');;
        });


    // Gallery
    Route::prefix('admin')->group(function () {
        Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
        // Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::post('/gallery/upload', [GalleryController::class, 'store']);
        Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });
    Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');

    //RDV
    Route::get('/ajouter-rdv', function () {
    return view('admin.rdvCreate');
    });

    Route::post('/ajouter-rdv',[RDVController::class, 'create'])->name('RDV.create');


    // PAYMENT
    Route::prefix('/payments')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
        Route::post('/store', [PaymentController::class, 'store'])->name('payment.store');
        // Route::get('', [PaymentController::class, 'index'])->name('payments.index');
        Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('payment.delete');
        Route::get('/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::put('/{id}', [PaymentController::class, 'update'])->name('payment.update');
    });


    // CASH MOVMENT

      Route::get('/cash-movements/create', [CashMovementController::class, 'create'])->name('cash_movements.create');
    Route::post('/cash-movements', [CashMovementController::class, 'store'])->name('cash_movements.store');

        // Show page to select patient + modal (create view)
    Route::get('bloc-payments/create', [BlocPaymentController::class, 'create'])->name('bloc-payments.create');

    // Store new bloc payment
    Route::post('/bloc-payments', [BlocPaymentController::class, 'store'])->name('bloc-payments.store');

    Route::prefix('/events')->group( function ()  {
        Route::get('', [EventController::class, 'index'])->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('', [EventController::class, 'store'])->name('events.store');
    Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    });


});

    Route::get('/rdv/confirmation', function () {
        return view('rdvConfirmed');
    })->name('rdv.confirmation');
    Route::post('/rendez-vous',[RDVController::class, 'store'])->name('RDVstore');
