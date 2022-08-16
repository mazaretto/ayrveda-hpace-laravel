<?php

use Illuminate\Support\Facades\Route;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
Route::get('/', 'HomeController@index')->name('home');
Route::get('fetch-cur', 'HomeController@fetchCur')->name('home.fetchCur');
Route::post('/identify', 'HomeController@identify')->name('home.identify');
Route::post('/supportSend', 'HomeController@supportSend')->name('home.supportSend');
Route::get('/reset-token', 'HomeController@resetToken')->name('home.resetToken');
Route::redirect('/home', '/');
Route::redirect('/index', '/');
Route::redirect('/admin', '/admin/dashboard');

Route::prefix('/locale')->group(function () {
  Route::get('/en', 'LocaleController@en')->name('locale.en');
  Route::get('/ru', 'LocaleController@ru')->name('locale.ru');
});

Route::middleware(['guest'])->group(function () {
  Route::view('/login', 'auth.login')->name('login');
  Route::view('/login-doctor', 'auth.login', ['doctor' => true])->name('login.doctor');
  Route::view('/register', 'auth.register')->name('register');
  Route::view('/doctor-register', 'auth.register', ['doctor' => true])->name('register.doctor');
});
Route::get('/logout', function () {
  Auth::logout();
  return redirect()->route('home');
})->name('logout');
Route::get('/profile', function () {
  $user = auth()->user();
  if ($user->hasRole('Patient')) {
    if (url()->previous() == route('login.doctor')) {
      auth()->logout();
      return redirect()->route('login.doctor')->with('message', trans('auth.not-a-doctor'));
    }
    return redirect()->route('patient.dashboard');
  } elseif ($user->hasRole('Doctor')) {
    if (url()->previous() == route('login')) {
      auth()->logout();
      return redirect()->route('login')->with('message', trans('auth.not-a-patient'));
    }
    return redirect()->route('doctor.dashboard');
  }
  return null;
});

// General
Route::prefix('/doctors-list')->group(function () {
  Route::get('/', 'DoctorProfiles@index')->name('doctors-list');
  Route::get('/search', 'DoctorProfiles@search')->name('search-doctor');
  Route::get('/doctor-profile/{id}', 'DoctorProfiles@show')->name('doctor-profile');
});

// Store
Route::prefix('/store')->group(function () {
  Route::get('/', 'Store\StoreController@index')->name('store');
  Route::get('/medicine/{id}', 'Store\StoreController@showMedicine')->name('store.medicine');
});

// Patients
Route::prefix('/patient')->middleware(['role:Patient'])->group(function () {
  Route::get('/profile', 'Patient\ProfileController@index')->name('patient.dashboard');

  Route::get('/my-diseases', 'Patient\DiseasesController@index')->name('patient.diseases');
  Route::post('/my-diseases', 'Patient\DiseasesController@set')->name('patient.diseases-set');

  Route::get('/settings', 'Patient\ProfileController@settings')->name('patient.settings');
  Route::post('/settings', 'Patient\ProfileController@setProfile')->name('patient.setProfile');

  Route::get('/uploaded-files', 'Patient\FilesController@index')->name('patient.files');
  Route::post('/uploaded-files', 'Patient\FilesController@store')->name('patient.add-files');
  Route::post('/uploaded-files/remove', 'Patient\FilesController@remove')->name('patient.remove-files');

  Route::get('/cart', 'Store\StoreController@cartPatient')->name('patient.cart');
  Route::get('/cart/details', 'Store\StoreController@cartPatientDetails')->name('patient.cart.details');
  Route::get('/cart-get-total', 'Store\CartController@total')->name('cart.total');
  Route::post('/cart-add', 'Store\CartController@add')->name('cart.add');
  Route::post('/cart-quantity', 'Store\CartController@changeQuantity')->name('cart.quantity');
  Route::post('/cart-remove', 'Store\CartController@remove')->name('cart.remove');
  Route::post('/cart-proceed', 'Store\CartController@cartProceed')->name('cart.proceed');

  Route::get('/cart/get-price', 'Store\CartController@getPrice')->name('cart.get-price');
  Route::get('/purchase-history', 'Patient\PurchasesController@index')->name('patient.purchase-history');
});

// Doctors
Route::prefix('/doctor')->middleware(['role:Doctor'])->group(function () {
  Route::get('/profile', 'Doctor\ProfileController@index')->name('doctor.dashboard');

  Route::get('/settings', 'Doctor\ProfileController@settings')->name('doctor.settings');
  Route::post('/settings', 'Doctor\ProfileController@setProfile')->name('doctor.setProfile');

  Route::get('/social', 'Doctor\ProfileController@social')->name('doctor.social');
  Route::post('/social', 'Doctor\ProfileController@setSocial')->name('doctor.setSocial');

  Route::get('/my-patients', 'Doctor\MyPatientsController@index')->name('doctor.my-patients');
  Route::post('/my-patients/add-prescription', 'Doctor\MyPatientsController@setPrescription')->name('doctor.add-prescription');
  Route::post('/my-patients/add-medical-record', 'Doctor\MyPatientsController@setMedicalRecord')->name('doctor.add-medical-record');

  Route::get('/my-patients/{id}', 'Doctor\MyPatientsController@show')->name('doctor.my-patient');

  Route::post('/add-patient', 'Doctor\MyPatientsController@add')->name('doctor.add-patient');
});

// Admin
Route::prefix('/admin')->middleware(['role:Admin|Seller'])->group(function () {
  Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');


  Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/doctors-list', 'Admin\DoctorsController@index')->name('admin.doctors-list');
    Route::get('/doctors-list/profile/{id}', 'Admin\DoctorsController@profile')->name('admin.doctor-profile');
    Route::post('/doctor-delete', 'Admin\DoctorsController@delete')->name('admin.doctor-delete');
    Route::post('/doctor-status', 'Admin\DoctorsController@status')->name('admin.doctor-status');
    Route::post('/doctor-add-patient', 'Admin\DoctorsController@addPatient')->name('admin.doctor-add-patient');

    Route::get('/patients-list', 'Admin\PatientsController@index')->name('admin.patients-list');
    Route::get('/patients-list/profile/{id}', 'Admin\PatientsController@profile')->name('admin.patient-profile');
    Route::post('/patient-delete', 'Admin\PatientsController@delete')->name('admin.patient-delete');

    Route::get('/diseases-list', 'Admin\DiseasesController@index')->name('admin.diseases-list');
    Route::post('/diseases-set', 'Admin\DiseasesController@set')->name('admin.diseases-set');
    Route::get('/support', 'Admin\SupportController@index')->name('admin.support');
    Route::get('/support/get', 'Admin\SupportController@showToken')->name('admin.support.token');
    Route::post('/support/delete', 'Admin\SupportController@deleteToken')->name('admin.support.delete');
    Route::post('/support/send', 'Admin\SupportController@send')->name('admin.support.send');

    Route::get('/settings', 'Admin\SettingsController@index')->name('admin.settings');
    Route::post('/settings', 'Admin\SettingsController@set')->name('admin.settings-set');

    Route::post('/seller-set', [\App\Http\Controllers\Admin\SellerController::class, 'set'])->name('admin.seller-set');
  });

  Route::get('/medicine-list', 'Admin\MedicineController@index')->name('admin.medicine-list');
  Route::get('/medicine-list/edit/{id}', 'Admin\MedicineController@edit')->name('admin.medicine-edit');
  Route::post('/medicine-list/add', 'Admin\MedicineController@add')->name('admin.medicine-add');
  Route::post('/medicine-list/edit', 'Admin\MedicineController@editSubmit')->name('admin.medicine-edit-submit');
  Route::post('/medicine-list/delete', 'Admin\MedicineController@delete')->name('admin.medicine-delete');

  Route::post('/medicine-list/image/{id}', 'Admin\MedicineController@imageUpload')->name('admin.medicine-image-upload');
  Route::post('/medicine-list/image/delete/{id}', 'Admin\MedicineController@imageDelete')->name('admin.medicine-image-delete');

  Route::get('/online-store', 'Store\StoreController@adminIndex')->name('admin.online-store');
  Route::get('/online-store/dismissed', 'Store\StoreController@adminIndexDismissed')->name('admin.online-store.dismissed');
  Route::get('/online-store/successful', 'Store\StoreController@adminIndexSuccessful')->name('admin.online-store.successful');
  Route::post('/online-store/next-stage', 'Store\StoreController@adminNext')->name('admin.online-store.next');

  /*
  Route::get('/appointment-list', function () {
    return view('admin.appointment-list');
  })->name('admin.appointment-list');
  Route::get('/specialities', function () {
    return view('admin.specialities');
  })->name('admin.specialities');

  Route::get('/reviews', function () {
    return view('admin.reviews');
  })->name('admin.reviews');
  Route::get('/transactions-list', function () {
    return view('admin.transactions-list');
  })->name('admin.transactions-list');
  Route::get('/invoice-report', function () {
    return view('admin.invoice-report');
  })->name('admin.invoice-report');

  Route::get('/login', function () {
    return view('admin.login');
  })->name('admin.login');
  Route::get('/register', function () {
    return view('admin.register');
  })->name('admin.register');
  Route::get('/forgot-password', function () {
    return view('admin.forgot-password');
  })->name('admin.forgot-password');
  Route::get('/lock-screen', function () {
    return view('admin.lock-screen');
  })->name('admin.lock-screen');
  Route::get('/error-404', function () {
    return view('admin.error-404');
  })->name('admin.error-404');
  Route::get('/error-500', function () {
    return view('admin.error-500');
  })->name('admin.error-500');
  Route::get('/blank-page', function () {
    return view('admin.blank-page');
  })->name('admin.blank-page');
  Route::get('/components', function () {
    return view('admin.components');
  })->name('admin.components');
  Route::get('/form-basic-inputs', function () {
    return view('admin.form-basic-inputs');
  })->name('admin.form-basic');
  Route::get('/form-input-groups', function () {
    return view('admin.form-input-groups');
  })->name('admin.form-inputs');
  Route::get('/form-horizontal', function () {
    return view('admin.form-horizontal');
  })->name('admin.form-horizontal');
  Route::get('/form-vertical', function () {
    return view('admin.form-vertical');
  })->name('admin.form-vertical');
  Route::get('/form-mask', function () {
    return view('admin.form-mask');
  })->name('admin.form-mask');
  Route::get('/form-validation', function () {
    return view('admin.form-validation');
  })->name('admin.form-validation');
  Route::get('/tables-basic', function () {
    return view('admin.tables-basic');
  })->name('admin.tables-basic');
  Route::get('/data-tables', function () {
    return view('admin.data-tables');
  })->name('admin.data-tables');
  Route::get('/invoice', function () {
    return view('invoice');
  })->name('admin.invoice');
  Route::get('/calendar', function () {
    return view('admin.calendar');
  })->name('admin.calendar');
  */
});

// Chat
Route::prefix('/chat')->middleware('auth')->group(function () {
  Route::get('/', 'ChatController@index')->name('chat');
  Route::get('/event', function () {
    $user = auth()->user();
    $message = $user->chatMessages()->create([
      'message' => 'new'
    ]);

    event(new \App\Events\MessageSent($user, $message));

    broadcast(new \App\Events\MessageSent($user, $message))->toOthers();
  });

  Route::post('/add-chat', 'ChatController@addChat')->name('chat.add');
  Route::post('/read', 'ChatController@read')->name('chat.read');

  Route::get('/get-cur-user', 'ChatController@curUser')->name('chat.cur-user');
  Route::get('/get-chat-info', 'ChatController@chatInfo')->name('chat.chat-info');
  Route::get('/get-messages', 'ChatController@fetch')->name('chat.fetch');
  Route::get('/attachment', 'ChatController@attachment')->name('chat.attachment');

  Route::post('/trans', 'ChatController@trans')->name('chat.trans');
  Route::post('/send-message', 'ChatController@send')->name('chat.send');
  Route::post('/file-upload', 'ChatController@uploadSingle')->name('chat.upload-single');
});

/*
Route::get('/change-password', function () {
  return view('change-password');
})->name('change-password');
Route::get('/doctor-change-password', function () {
  return view('doctor-change-password');
});
Route::get('/calendar', function () {
  return view('calendar');
})->name('calendar');
Route::get('/components', function () {
  return view('components');
})->name('components');
Route::get('/blank-page', function () {
  return view('blank-page');
})->name('blank-page');

Route::get('/forgot-password', function () {
  return view('forgot-password');
})->name('forgot-password');
Route::get('/add-prescription', function () {
  return view('add-prescription');
});
Route::get('/edit-prescription', function () {
  return view('edit-prescription');
});
Route::get('/privacy-policy', function () {
  return view('privacy-policy');
})->name('privacy-policy');
Route::get('/term-condition', function () {
  return view('term-condition');
})->name('term-condition');
*/


Auth::routes();
