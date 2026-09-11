<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FactureController;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\Activity;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportController;
Route::get('/', function () {
    return view('welcome');
});

// --- Authentification (accessible sans être connecté) ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- Tout ce qui nécessite d'être connecté ---
Route::middleware('auth')->group(function () {

   Route::get('/dashboard', function () {
    return view('dashboard', [
        'clientsCount'   => Client::count(),
        'productsCount'  => Product::count(),
        'devisCount'     => Devis::count(),
        'facturesCount'  => Facture::count(),
        'activities'     => Activity::latest()->take(5)->get(),
    ]);
})->name('dashboard');
 

    Route::resource('clients', ClientController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('products', ProductController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('employees', EmployeeController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/create', [DevisController::class, 'create'])->name('devis.create');
    Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');
    Route::get('/devis/{devis}', [DevisController::class, 'show'])->name('devis.show');
    Route::put('/devis/{devis}/statut', [DevisController::class, 'updateStatut'])->name('devis.statut');
    Route::delete('/devis/{devis}', [DevisController::class, 'destroy'])->name('devis.destroy');



 
 
// --- EN DEHORS du groupe auth, à mettre directement dans routes/web.php ---
// Ces 3 routes sont PUBLIQUES : pas besoin d'être connecté, mais protégées
// par une signature cryptographique (impossible à deviner/falsifier).
 
Route::middleware('signed')->group(function () {
    Route::get('/devis/{devis}/consulter', [DevisController::class, 'consulter'])->name('devis.consulter');
    Route::get('/devis/{devis}/accepter', [DevisController::class, 'accepter'])->name('devis.accepter');
    Route::get('/devis/{devis}/refuser', [DevisController::class, 'refuser'])->name('devis.refuser');
});
 
Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');
Route::get('/factures/create', [FactureController::class, 'create'])->name('factures.create');
Route::post('/factures', [FactureController::class, 'store'])->name('factures.store');
Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('factures.show');
Route::put('/factures/{facture}/statut', [FactureController::class, 'updateStatut'])->name('factures.statut');
Route::delete('/factures/{facture}', [FactureController::class, 'destroy'])->name('factures.destroy');
 
// Le bouton "Transformer en facture" sur la page devis.show pointe ici
Route::post('/devis/{devis}/facturer', [FactureController::class, 'convertirDepuisDevis'])->name('devis.facturer');

 
Route::get('/parametres', [ProfileController::class, 'edit'])->name('settings.edit');
Route::put('/parametres', [ProfileController::class, 'update'])->name('settings.update');
Route::put('/parametres/password', [ProfileController::class, 'updatePassword'])->name('settings.password');

 
Route::get('/credits', [CreditController::class, 'index'])->name('credits.index');
Route::get('/credits/create', [CreditController::class, 'create'])->name('credits.create');
Route::post('/credits', [CreditController::class, 'store'])->name('credits.store');
Route::post('/credits/{credit}/paiement', [CreditController::class, 'enregistrerPaiement'])->name('credits.paiement');
Route::delete('/credits/{credit}', [CreditController::class, 'destroy'])->name('credits.destroy');

Route::resource('fournisseurs', FournisseurController::class)
    ->only(['index', 'store', 'update', 'destroy']);
  
 
Route::get('/chiffre-affaires', [FinanceController::class, 'index'])->name('finances.index');

 
Route::get('/analytique', [AnalyticsController::class, 'index'])->name('analytics.index');

 
Route::get('/rapports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/rapports/export', [ReportController::class, 'exportCsv'])->name('reports.export');
});