<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubCriteriaController;
use App\Http\Controllers\Admin\PendaftaranSiswaController;
use App\Http\Controllers\Admin\DataCriteriaController;
use App\Http\Controllers\Admin\PerbandinganCriteriaController;
use App\Http\Controllers\Admin\RatioCriteriaController;
use App\Http\Controllers\Admin\RatioAlternativeController;
use App\Http\Controllers\Admin\HasilRankingController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Siswa\HasilRankingSiswaController;
use App\Http\Controllers\Guru\DataKriteriaController;
use App\Http\Controllers\Guru\PerbandinganKriteriaController;
use App\Http\Controllers\Guru\RatioKriteriaController;
use App\Http\Controllers\Guru\RatioAlternatifController;
use App\Http\Controllers\Guru\HasilPerangkinganController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::post('login', 'postLogin')->name('login.post');
    Route::post('register', 'postregister')->name('register.post');
    Route::get('logout', 'logout')->name('logout');
});

// ADMIN
Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index']);

    // DATA USER
    Route::resource('/admin/user', UserController::class);

    // DATA KRITERIA
    Route::get('/admin/kriteria', [CriteriaController::class, 'index']);
    Route::get('/admin/kriteria/form', [CriteriaController::class, 'tampilform']);
    Route::post('/admin/kriteria/form/postkriteria', [CriteriaController::class, 'postkriteria'])->name('postkriteria');
    Route::get('/admin/kriteria/formedit/{id}', [CriteriaController::class, 'tampileditkriteria'])->name('editkriteria');
    Route::post('/admin/kriteria/formedit/updatekriteria/{id}', [CriteriaController::class, 'updatekriteria'])->name('updatekriteria');
    Route::get('/admin/kriteria/hapuskriteria/{criteria}', [CriteriaController::class, 'delskriteria'])->name('hapuskriteria');

    // DATA SISWA
    Route::resource('/admin/siswa', PendaftaranSiswaController::class);

    // DATA ALTERNATIVE
    Route::get('/admin/alternatif', [AlternativeController::class, 'index']);
    Route::get('/admin/alternatif/form', [AlternativeController::class, 'tampilform']);
    Route::post('/admin/alternatif/form/postalternatif', [AlternativeController::class, 'postalternatif'])->name('postalternatif');
    Route::get('/admin/alternatif/formedit/{id}', [AlternativeController::class, 'tampileditalternatif'])->name('editalternatif');
    Route::post('/admin/alternatif/formedit/updatealternatif/{id}', [AlternativeController::class, 'updatealternatif'])->name('updatealternatif');
    Route::get('/admin/alternatif/hapusalternatif/{alternative}', [AlternativeController::class, 'delalternatif'])->name('hapusalternatif');

    Route::get('/admin/criteriaData', [DataCriteriaController::class, 'index'])->name('criteriaData');
    Route::post('/admin/upsertData', [DataCriteriaController::class, 'store'])->name('upsertData');
    Route::get('/admin/deleteData/{id}', [DataCriteriaController::class, 'destroy'])->name('deleteData');

    Route::get('/admin/perbandingan/criteria', [PerbandinganCriteriaController::class, 'index'])->name('criteria');
    Route::get('/admin/perbandingan/criteria/deleteCriteria/{criteria}', [PerbandinganCriteriaController::class, 'destroy'])->name('deleteCriteria');

    Route::get('/admin/ratioCriteria', [RatioCriteriaController::class, 'index'])->name('ratioCriteria');
    Route::post('/admin/addRatioCriteria', [PerbandinganCriteriaController::class, 'storeRatio'])->name('addRatioCriteria');
    Route::post('/admin/massRatioCriteria', [PerbandinganCriteriaController::class, 'massUpdate'])->name('massRatioCriteria');
    Route::get('/admin/deleteRatioCriteria/{v_id}/{h_id}', [RatioCriteriaController::class, 'destroy'])->name('deleteRatioCriteria');

    Route::get('/admin/ratioAlternative', [RatioAlternativeController::class, 'index'])->name('ratioAlternative');
    Route::post('/admin/addRatioAlternative', [RatioAlternativeController::class, 'store'])->name('addRatioAlternative');
    Route::get('/admin/resultAlternative', function () {

        $data = RatioAlternativeController::showAlternative();

        if (!$data) {
            return redirect('ratioAlternative')->with(['message' => 'data belum lengkap']);
        }
        return view('admin/package/analisis/ratioAlternative')->with('data', $data);
    })->name('resultAlternative');
    Route::get('/admin/deleteRatioAlternative/{criterias_id}/{v_id}/{h_id}', [RatioAlternativeController::class, 'destroy'])->name('deleteRatioAlternative');
    Route::post('/admin/massRatioAlternative', [RatioAlternativeController::class, 'massUpdate'])->name('massRatioAlternative');

    Route::get('/admin/rangking', [HasilRankingController::class, 'index'])->name('rangking');
});

// GURU
Route::group(['middleware' => ['auth', 'ceklevel:guru']], function () {
    Route::get('/guru', [GuruController::class, 'index']);

    Route::get('/guru/criteriaData', [DataKriteriaController::class, 'index'])->name('criteriaData');
    Route::post('/guru/upsertData', [DataKriteriaController::class, 'store'])->name('upsertData');
    Route::get('/guru/deleteData/{id}', [DataKriteriaController::class, 'destroy'])->name('deleteData');

    Route::get('/guru/perbandingan/criteria', [PerbandinganKriteriaController::class, 'index'])->name('criteria');
    Route::get('/guru/perbandingan/criteria/deleteCriteria/{criteria}', [PerbandinganKriteriaController::class, 'destroy'])->name('deleteCriteria');

    Route::get('/guru/ratioCriteria', [RatioKriteriaController::class, 'index'])->name('ratioCriteria');
    Route::post('/guru/addRatioCriteria', [PerbandinganKriteriaController::class, 'storeRatio'])->name('addRatioCriteria');
    Route::post('/guru/massRatioCriteria', [PerbandinganKriteriaController::class, 'massUpdate'])->name('massRatioCriteria');
    Route::get('/guru/deleteRatioCriteria/{v_id}/{h_id}', [RatioCriteriaController::class, 'destroy'])->name('deleteRatioCriteria');

    Route::get('/guru/ratioAlternative', [RatioAlternatifController::class, 'index'])->name('ratioAlternative');
    Route::post('/guru/addRatioAlternative', [RatioAlternatifController::class, 'store'])->name('addRatioAlternative');
    Route::get('/guru/resultAlternative', function () {

        $data = RatioAlternatifController::showAlternative();

        if (!$data) {
            return redirect('ratioAlternative')->with(['message' => 'data belum lengkap']);
        }
        return view('guru/package/analisis/ratioAlternative')->with('data', $data);
    })->name('resultAlternative');
    Route::get('/guru/deleteRatioAlternative/{criterias_id}/{v_id}/{h_id}', [RatioAlternatifController::class, 'destroy'])->name('deleteRatioAlternative');
    Route::post('/guru/massRatioAlternative', [RatioAlternatifController::class, 'massUpdate'])->name('massRatioAlternative');

    Route::get('/guru/rangking', [HasilPerangkinganController::class, 'index'])->name('rangking');
});

// SISWA
Route::group(['middleware' => ['auth', 'ceklevel:siswa']], function () {
    
    Route::resource('/user/siswa', SiswaController::class);
    Route::get('/user/rangking', [HasilRankingSiswaController::class, 'index'])->name('rangking');
});

// TAMPILAN FRONTEND USER
Route::get('/frontend-dashboard', [FrontendController::class, 'frontendDashboard'])->name('frontend.dashboard');
Route::get('/frontend-detail', [FrontendController::class, 'frontendDetail'])->name('frontend.detail');
Route::get('/frontend-galeri', [FrontendController::class, 'frontendGaleri'])->name('frontend.galeri');
Route::get('/frontend-rangking', [FrontendController::class, 'frontendRangking'])->name('frontend.ranking');

