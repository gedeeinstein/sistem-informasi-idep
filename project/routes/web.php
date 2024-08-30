<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\DusunController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CountryCountroller;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\AuditLogsController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\PermissionsController;


Route::get('/', function () {
    $title = "LOGIN IDEP SERVER";
    return view('auth.login', ['title'=> $title]);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('home')->with('status', session('status'));
    }
    return redirect()->route('home');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
// Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    // Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    


    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::post('users/media', [UsersController::class, 'storeMedia'])->name('users.storeMedia');
    Route::post('users/ckmedia', [UsersController::class,'storeCKEditorImages'])->name('users.storeCKEditorImages');
    Route::resource('users', UsersController::class);

    //Logs
    Route::resource('audit-logs', AuditLogsController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Country
    Route::delete('country/destroy', [CountryCountroller::class, 'massDestroy'])->name('country.massDestroy');
    Route::post('country/media', [CountryCountroller::class, 'storeMedia'])->name('country.storeMedia');
    Route::post('country/ckmedia', [CountryCountroller::class, 'storeCKEditorImages'])->name('country.storeCKEditorImages');
    Route::resource('country', CountryCountroller::class);
    Route::get('listcountry', [CountryCountroller::class, 'countrylist'])->name('country.data');

    //Provinsi
    Route::resource('provinsi', ProvinsiController::class);
    Route::get('dataprovinsi', [ProvinsiController::class, 'dataprovinsi'])->name('provinsi.data');
    Route::get('provinsi/getedit/{provinsi}', [ProvinsiController::class, 'get_edit'])->name('provinsi.getedit');

    //Kabupaten
    Route::get('datakabupaten', [KabupatenController::class, 'datakabupaten'])->name('data.kabupaten');
    Route::get('kabupaten.figma', [KabupatenController::class, 'figma'])->name('kabupaten.figma');
    Route::resource('kabupaten', KabupatenController::class);

    //Get Data in Kecamatan
    Route::get('datakecamatan', [KecamatanController::class, 'datakecamatan'])->name('data.kecamatan');
    Route::get('prov.data', [KecamatanController::class, 'provinsi'])->name('prov.data');
    Route::get('prov.data/{provinsi}', [KecamatanController::class, 'provinsi_details'])->name('prov_data');
    Route::get('kab.data/{id}', [KecamatanController::class, 'kab'])->name('kab.data');
    Route::get('kab.data/{kabupaten}', [KecamatanController::class, 'kab_details'])->name('kab_data');
    Route::get('kabupaten_data/{id}', [KecamatanController::class, 'getKabupatenByProvinsi'])->name('kabupaten_data');
    Route::resource('kecamatan', KecamatanController::class);

    //Desa
    Route::get('data-desa', [DesaController::class, 'getDesa'])->name('data.desa');
    Route::get('data-kec/{id}', [DesaController::class, 'getKecamatan'])->name('kec.data');
    Route::resource('desa', DesaController::class);

    Route::get('data-dusun', [DusunController::class, 'getDusun'])->name('data.dusun');
    Route::resource('dusun', DusunController::class);

});
