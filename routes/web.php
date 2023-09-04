<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\Asignar\AsignarController;
use App\Http\Livewire\Permisos\PermisosController;
use App\Http\Livewire\Role\RoleController;
use App\Http\Livewire\Storehouse\Boss\BossController;
use App\Http\Livewire\Storehouse\Family\FamilyController;
use App\Http\Livewire\Storehouse\Inventory\InventoryController;
use App\Http\Livewire\Storehouse\Measurementunits\MeaserementunitControlle;
use App\Http\Livewire\Storehouse\Warehouse\EntriesController;
use App\Http\Livewire\Storehouse\Warehouse\ReprinterController;
use App\Http\Livewire\Storehouse\WarehouseRequest\DeparturesController;
use App\Http\Livewire\User\UserController;
use Illuminate\Routing\RouteGroup;
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

Route::get('/', function () {return view('auth.login');});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    //Rutas de la tabla usuarios
    Route::middleware(['role_or_permission:SuperUser'])->group(function () {
        Route::group(['prefix' => 'Admin'], function(){
            Route::get('Users', UserController::class)->name('indexUsers');
            Route::get('Roles', RoleController::class)->name('indexRoles');
            Route::get('Permisos', PermisosController::class)->name('indexPermisos');
            Route::get('AsignarPermisos', AsignarController::class)->name('indexAsignarPermisos');
            Route::get('Cargo', BossController::class)->name('indexBoss');

        });
    });

    Route::middleware(['role_or_permission:SuperUser|Almcenista'])->group(function () {
        Route::group(['prefix' => 'Almacen'], function(){
            Route::get('Unidades', MeaserementunitControlle::class)->name('indexUnits');
            Route::get('Familias', FamilyController::class)->name('indexFamily');
            Route::get('Inventario', InventoryController::class)->name('indexInventory');
            Route::get('EntradaAlmacen/Captura', EntriesController::class)->name('indexEntrada');
            Route::get('EntradaAlmacen/Reimpresion', ReprinterController::class)->name('indexReEntrada');
            Route::get('entrada/{id}',[ExportController::class, 'reportPDF']);
        });
    });

    Route::middleware(['role_or_permission:SuperUser|Almcenista|Usuarios'])->group(function () {
        Route::get('Almacen/Solicitud', DeparturesController::class)->name('indexSolicitud');
        Route::get('requerimiento/{id}',[ExportController::class, 'Requisicion']);
    });
});
