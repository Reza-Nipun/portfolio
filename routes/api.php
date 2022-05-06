<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserAuthController::class,'register']);
Route::post('/login', [UserAuthController::class,'login']);
Route::get('/user/{user_name}', [UserAuthController::class,'user']);
Route::get('/tags/{user_id}', [TagController::class,'userTags']);
Route::get('/skills/{user_id}', [SkillController::class,'userSkills']);
Route::get('/services/{user_id}', [ServiceController::class,'userServices']);
Route::get('/links/{user_id}', [LinksController::class,'userLinks']);
Route::get('/certificates/{user_id}', [CertificateController::class,'userCertificates']);
Route::get('/portfolios/{user_id}', [PortfolioController::class,'userPortfolios']);
Route::get('/blogs/{user_id}', [BlogController::class,'userBlogs']);
Route::post('/send_message', [ContactController::class,'senderMessage']);

Route::post('/download_file', [UserAuthController::class,'downloadFile']);

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserAuthController::class,'users']);
    Route::get('/me', [UserAuthController::class,'me']);
    Route::post('/update_user', [UserAuthController::class,'updateUser']);

    Route::get('/skills', [SkillController::class,'getUserWiseSkills']);
    Route::get('/skill/{id}', [SkillController::class,'getSkillById']);
    Route::put('/skill/{id}', [SkillController::class,'updateSkill']);

    Route::get('/tags', [TagController::class,'getUserWiseTags']);
    Route::get('/tag/{id}', [TagController::class,'getTagById']);
    Route::put('/tag/{id}', [TagController::class,'updateTag']);
    
    Route::get('/services', [ServiceController::class,'getUserWiseServices']);
    Route::get('/service/{id}', [ServiceController::class,'getServiceById']);
    Route::put('/service/{id}', [ServiceController::class,'updateService']);

    Route::get('/links', [LinksController::class,'getUserWiseLinks']);
    
    Route::get('/certificates', [CertificateController::class,'getUserWiseCertificates']);
    Route::get('/certificate/{id}', [CertificateController::class,'getCertificateById']);
    Route::put('/certificate/{id}', [CertificateController::class,'updateCertificate']);

    Route::get('/portfolios', [PortfolioController::class,'getUserWisePortfolios']);
    Route::get('/blogs', [BlogController::class,'getUserWiseBlogs']);
    Route::get('/logout', [UserAuthController::class,'logout']);
});
