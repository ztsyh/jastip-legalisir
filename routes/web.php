<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth.guard:web'])->group(function () {
    Route::group(['middleware' => ['guest'], 'prefix' => '/auth', 'as' => 'auth.'], function () {
        Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('login');
        Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
        Route::get("/register", [\App\Http\Controllers\Auth\RegisterController::class, "index"])->name('register');
        Route::post("/register", [\App\Http\Controllers\Auth\RegisterController::class, "store"]);
        Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('logout');
    });

    Route::group(['middleware' => ['auth', 'user.detail']], function () {

        Route::group(['prefix' => '/profile'], function () {
            Route::get("/", [\App\Http\Controllers\ProfileController::class, "index"])->name("profile")->withoutMiddleware('user.detail');
            Route::post("/", [\App\Http\Controllers\ProfileController::class, "store"])->withoutMiddleware('user.detail');
        });

        Route::redirect("/", \App\Providers\RouteServiceProvider::HOME);

        Route::group(['prefix' => '/auth'], function () {
            Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('auth.logout')->withoutMiddleware('user.detail');
        });


        Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function () {
            Route::group(['prefix' => '{invoice}'], function () {
                Route::get("/", [\App\Http\Controllers\InvoiceController::class, "show"])->name('method');
                Route::post("/", [\App\Http\Controllers\InvoiceController::class, "store"]);
                Route::get("/payment", [\App\Http\Controllers\Invoice\PaymentController::class, "show"])->name('payment');
                Route::post("/payment", [\App\Http\Controllers\Invoice\PaymentController::class, "store"])->name('payment.confirmation');
            });
        });

        Route::group(['prefix' => '/attachment'], function () {
            Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"])->name('attachment');
        });

        Route::group(['prefix' => '/pengajuan-legalisir'], function () {
            Route::group(['prefix' => '/ijazah'], function () {
                Route::get("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "create"]);
                Route::post("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "store"]);
            });
        });
        Route::group(['prefix' => '/check', 'as' => 'check.'], function () {
            Route::get('/status', [\App\Http\Controllers\Check\StatusController::class, 'index'])->name('list');
        });
        Route::group(['prefix' => '/riwayat', 'as' => 'riwayat.'], function () {
            Route::get('/', [\App\Http\Controllers\RiwayatController::class, 'index'])->name('list');
            Route::group(['prefix' => '/{transaction}'], function () {
                Route::get('/', [\App\Http\Controllers\RiwayatController::class, 'show'])->name('detail');
                Route::get('/log', [\App\Http\Controllers\Riwayat\LogController::class, 'show'])->name('log');
            });
            Route::group(['prefix'=>'{order}','as'=>'order.'],function (){
                Route::get('/receive', [\App\Http\Controllers\Riwayat\ReceiveController::class, 'store'])->name('receive');
            });
        });


    });
});
Route::middleware(['auth.guard:admin'])->group(function () {
    Route::group(['middleware' => ['guest:admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('login');
            Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
        });
    });
    Route::group(['middleware' => ['auth:admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {

        Route::group(['prefix' => '/attachment'], function () {
            Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"])->name('attachment');
        });

        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('logout');
        });

        Route::group(['prefix' => '/pengajuan-legalisir', 'as' => 'pengajuan-legalisir.'], function () {
            Route::group(['prefix' => '/ijazah'], function () {
                Route::get("/", [\App\Http\Controllers\Admin\PengajuanLegalisir\IjazahController::class, "index"])->name("ijazah");
                Route::group(['prefix' => "{transaction}", "as" => 'ijazah.'], function () {
                    Route::get("/", [\App\Http\Controllers\Admin\PengajuanLegalisir\IjazahController::class, "show"])->name("detail");
                });
            });
        });

        Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function () {
            Route::group(['prefix' => '{invoice}'], function () {
                Route::post("/confirm", [\App\Http\Controllers\Admin\Invoice\PaymentController::class, "store"])->name('payment.confirmation');
            });
        });

    });
});
Route::middleware(['auth.guard:sprinter'])->group(function () {
    Route::group(['middleware' => ['guest:sprinter'], 'prefix' => '/sprinter', 'as' => 'sprinter.'], function () {
        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('login');
            Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
            Route::get("/register", [\App\Http\Controllers\Auth\RegisterController::class, "index"])->name('register');
            Route::post("/register", [\App\Http\Controllers\Auth\RegisterController::class, "store"]);

        });
    });

    Route::group(['middleware' => ['auth:sprinter'], 'prefix' => '/sprinter', 'as' => 'sprinter.'], function () {

        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('logout');
        });

        Route::group(['prefix' => '/attachment'], function () {
            Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"])->name('attachment');
        });


        Route::group(['prefix' => '/order', 'as' => 'order.'], function () {
            Route::group(['prefix' => '/ongoing'], function () {
                Route::group(['prefix' => '/{order}', 'as' => 'ongoing.'], function () {
                    Route::get("/", [\App\Http\Controllers\Sprinter\Order\OngoingController::class, "show"])->name("detail");

                    Route::post("/print", [\App\Http\Controllers\Sprinter\Order\Ongoing\PrintController::class, "store"])->name("print");
                    Route::post("/to-university", [\App\Http\Controllers\Sprinter\Order\Ongoing\ToUniversityController::class, "store"])->name("to.university");
                    Route::post("/arrived-university", [\App\Http\Controllers\Sprinter\Order\Ongoing\ArrivedUniversityController::class, "store"])->name("arrived.university");
                    Route::post("/legal-processing", [\App\Http\Controllers\Sprinter\Order\Ongoing\LegalProcessController::class, "store"])->name("legal.process");
                    Route::post("/legal-processed", [\App\Http\Controllers\Sprinter\Order\Ongoing\LegalDoneController::class, "store"])->name("legal.done");
                    Route::post("/packing", [\App\Http\Controllers\Sprinter\Order\Ongoing\PackingController::class, "store"])->name("packing");
                    Route::post("/packed", [\App\Http\Controllers\Sprinter\Order\Ongoing\PackedController::class, "store"])->name("packed");
                    Route::post("/to-shipment", [\App\Http\Controllers\Sprinter\Order\Ongoing\ToShipmentPartnerController::class, "store"])->name("to.shipment");
                    Route::post("/shipping", [\App\Http\Controllers\Sprinter\Order\Ongoing\ShippingController::class, "store"])->name("shipping");
                });
                Route::get("/", [\App\Http\Controllers\Sprinter\Order\OngoingController::class, "index"])->name("ongoing");
            });
            Route::group(['prefix' => '/incoming'], function () {
                Route::get("/", [\App\Http\Controllers\Sprinter\Order\IncomingController::class, "index"])->name("incoming");

                Route::group(['prefix' => '/{transaction}'], function () {
                    Route::post("/", [\App\Http\Controllers\Sprinter\Order\IncomingController::class, "store"])->name("incoming.take");
                });
            });
        });
    });
});
