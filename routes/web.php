<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TechController;
use App\Http\Controllers\TechReportController;
use App\Http\Controllers\EnginieurController;
use App\Http\Controllers\OrdreInterventionController;
use App\Http\Controllers\PVReceptionController;
use App\Http\Controllers\CheckListController;


/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
*/

// 🟢 Auth - Login & Register
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// 🏠 Home
Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

// 👥 Clients (Remove Profile Routes)
Route::middleware('auth')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
});

// 🔧 Tech (Technician)
Route::prefix('tech')->middleware('auth')->group(function () {
    Route::get('/', [TechController::class, 'dashboard'])->name('tech.dashboard');
    Route::get('/demandes', [TechController::class, 'demandes'])->name('tech.demandes');
    Route::get('/interventions', [TechController::class, 'interventions'])->name('tech.interventions');

    // 📄 Tech Reports
    Route::prefix('reports')->group(function () {
        Route::get('{id}/write', [TechReportController::class, 'write'])->name('tech.reports.write');
        Route::post('{id}/store', [TechReportController::class, 'store'])->name('tech.reports.store');
        Route::get('{id}/view', [TechReportController::class, 'view'])->name('tech.reports.view');
        Route::get('{id}/upload', [TechReportController::class, 'upload'])->name('tech.reports.upload');
        Route::post('{id}/upload', [TechReportController::class, 'storeUpload'])->name('tech.reports.storeUpload');
        Route::get('{id}/scanned', [TechReportController::class, 'scanned'])->name('tech.reports.scanned');
        Route::get('{id}/edit', [TechReportController::class, 'edit'])->name('tech.reports.edit');
        Route::put('{id}', [TechReportController::class, 'update'])->name('tech.reports.update');
        Route::delete('{id}', [TechReportController::class, 'destroy'])->name('tech.reports.destroy');
    });
});

// 👨‍💼 Ingénieur (Engineer)
Route::prefix('enginieur')->middleware('auth')->group(function () {
    Route::get('/dashboard', [EnginieurController::class, 'dashboard'])->name('enginieur.dashboard');

    // 📋 Ordre d'Intervention
    Route::get('/ordre', [OrdreInterventionController::class, 'index'])->name('enginieur.ordre.index');
    Route::post('/ordre', [OrdreInterventionController::class, 'store'])->name('enginieur.ordre.store');
    Route::get('/ordre/{id}/voir', [OrdreInterventionController::class, 'show'])->name('enginieur.ordre.show');
    Route::get('/ordre/{id}/modifier', [OrdreInterventionController::class, 'edit'])->name('enginieur.ordre.edit');
    Route::put('/ordre/{id}', [OrdreInterventionController::class, 'update'])->name('enginieur.ordre.update');
    Route::delete('/ordre/{id}/supprimer', [OrdreInterventionController::class, 'destroy'])->name('enginieur.ordre.destroy');

    // 📋 Liste des PVs (Reception)
    Route::get('/pv-reception', [PVReceptionController::class, 'index'])->name('enginieur.pv');
    Route::post('/pv-reception', [PVReceptionController::class, 'store'])->name('enginieur.pv.store');
    Route::get('/pv-reception/{id}/voir', [PVReceptionController::class, 'show'])->name('enginieur.pv.show');
    Route::get('/pv-reception/{id}/modifier', [PVReceptionController::class, 'edit'])->name('enginieur.pv.edit');
    Route::put('/pv-reception/{id}', [PVReceptionController::class, 'update'])->name('enginieur.pv.update');
    Route::delete('/pv-reception/{id}/supprimer', [PVReceptionController::class, 'destroy'])->name('enginieur.pv.destroy');

    // ✅ Checklists
    Route::get('/check', [CheckListController::class, 'index'])->name('enginieur.check.index');
    Route::post('/check', [CheckListController::class, 'store'])->name('enginieur.check.store');
    Route::get('/check/{id}/voir', [CheckListController::class, 'show'])->name('enginieur.check.show');
    Route::get('/check/{id}/modifier', [CheckListController::class, 'edit'])->name('enginieur.check.edit');
    Route::put('/check/{id}', [CheckListController::class, 'update'])->name('enginieur.check.update');
    Route::delete('/check/{id}/supprimer', [CheckListController::class, 'destroy'])->name('enginieur.check.destroy');
});
