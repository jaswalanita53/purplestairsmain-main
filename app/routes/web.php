<?php

use App\Http\Livewire\CandidateStep1;
use Illuminate\Support\Facades\Auth;
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
Route::get('signup-candidate', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('candidate.signup');  //Task #86a0gbv9f
Auth::routes();

//verification routes
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

// if not allowed SSO for employers
Route::get('no-sso-employers', [App\Http\Controllers\CompanyController::class, 'no_sso_employer']);
Route::post('no-sso-employers', [App\Http\Controllers\CompanyController::class, 'no_sso_employer']);
// if not allowed SSO for employers end

//employer login pages
Route::get('/employer/signup', [App\Http\Controllers\PagesController::class, 'employerSignup'])->name('employer.signup'); // task - 8678ffnbw
Route::get('/employer/login', [App\Http\Controllers\PagesController::class, 'employerLogin'])->name('employer.login');
Route::get('/employer/verify', [App\Http\Controllers\PagesController::class, 'employerVerify'])->name('employer.verify');

// task - 86a32nrge
Route::post('/verify_account', [App\Http\Controllers\Auth\LoginController::class, 'verifyAccount']);

//Social media register routes ends
//front pages routes starts
Route::get('/', [App\Http\Controllers\PagesController::class, 'welcome'])->name('welcome');
Route::get('/our-mission', [App\Http\Controllers\PagesController::class, 'mission'])->name('mission');
Route::get('/feature', [App\Http\Controllers\PagesController::class, 'features'])->name('features');
Route::get('/pricing', [App\Http\Controllers\PagesController::class, 'pricing'])->name('pricing');
Route::get('/faq', [App\Http\Controllers\PagesController::class, 'faq'])->name('faq');
Route::get('/contact', [App\Http\Controllers\PagesController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [App\Http\Controllers\PagesController::class, 'privacy'])->name('privacy');
Route::get('/terms', [App\Http\Controllers\PagesController::class, 'terms'])->name('terms');
Route::get('/signup-select', [App\Http\Controllers\PagesController::class, 'signupselect'])->name('signupselect');

//routes need to check onboarding
Route::group(['middleware' => ['auth', 'onboarding']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/sidebar_toggle', [App\Http\Controllers\HomeController::class, 'toggle_sidebar'])->name('toggle'); // sidebar toggle

    Route::get('/candidate/requests', [App\Http\Controllers\CandidateController::class, 'requests'])->name('candidates.requests');
    Route::get('/candidate/edit/personal', [App\Http\Controllers\CandidateController::class, 'editPersonal'])->name('candidates.editpersonal');
    Route::get('/candidate/edit/preferences', [App\Http\Controllers\CandidateController::class, 'editPreferences'])->name('candidates.editpreferences');
    Route::get('/candidate/edit/resume', [App\Http\Controllers\CandidateController::class, 'editResume'])->name('candidates.editresume');
    Route::get('/candidate/manage-account', [App\Http\Controllers\CandidateController::class, 'manageAccount'])->name('candidates.manageaccount'); // task - 86a2cwfq4

    Route::get('/company/dashboard', [App\Http\Controllers\CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/company/saved-searches', [App\Http\Controllers\CompanyController::class, 'savedSearches'])->name('company.savedsearches');
    Route::get('/company/archived-searches', [App\Http\Controllers\CompanyController::class, 'archivedSearches'])->name('company.archivedsearches');
    Route::get('/company/saved-search/{slug}', [App\Http\Controllers\CompanyController::class, 'savedSearch'])->name('company.savedsearch');

    // task - 86a0h5tzx
    Route::get('/company/requested', [App\Http\Controllers\CompanyController::class, 'requestedList'])->name('company.requested');
    Route::get('/company/unmasked', [App\Http\Controllers\CompanyController::class, 'unmaskedList'])->name('company.unmasked');
    // task - 86a0h5tzx end
    Route::get('/company/unmasked/{id}', [App\Http\Controllers\CompanyController::class, 'unmaskedList'])->name('company.viewunmasked'); // task - 86a1h4c1h

    Route::get('/company/archived-search/{slug}', [App\Http\Controllers\CompanyController::class, 'archivedSearch'])->name('company.archivedsearch');
    Route::get('/company/profile/edit', [App\Http\Controllers\CompanyController::class, 'editProfile'])->name('company.editprofile');
    Route::get('/company/profile/view', [App\Http\Controllers\CompanyController::class, 'viewProfile'])->name('company.viewprofile');
    Route::get('/company/candidate/profile/{user_id}', [App\Http\Controllers\CompanyController::class, 'candidateProfile'])->name('company.candidateprofile');
    Route::get('/company/manage-subsciption', [App\Http\Controllers\CompanyController::class, 'manageSubsciption'])->name('company.manage.subsciption');
    Route::get('/company/payment-history', [App\Http\Controllers\CompanyController::class, 'paymentHistory'])->name('company.paymenthistory'); // task - 86a28zyzx
    Route::get('/company/manage-account', [App\Http\Controllers\CompanyController::class, 'manageAccount'])->name('company.manageaccount'); // task - 86a28zyzx

    Route::get('/company/udate-zipcode', [App\Http\Controllers\CompanyController::class, 'updateLatLng']);

    // loom video updates : 19/03/24
    Route::post('/dashboard/savefavorite', [App\Http\Controllers\CompanyController::class, 'saveFavoriteMainList']);
    Route::post('/dashboard/removefavorite', [App\Http\Controllers\CompanyController::class, 'removeFavoriteMainList']);

    // task - 86a309hbq
    Route::post('/company/savefavorite', [App\Http\Controllers\CompanyController::class, 'saveFavorite']);
    Route::post('/company/removefavorite', [App\Http\Controllers\CompanyController::class, 'removeFavorite']);
    Route::post('/company/saverelevant', [App\Http\Controllers\CompanyController::class, 'saveRelevant']);
    Route::post('/company/removerelevant', [App\Http\Controllers\CompanyController::class, 'removeRelevant']);
    Route::post('/company/savenonerelevant', [App\Http\Controllers\CompanyController::class, 'saveNonRelevant']);
    Route::post('/company/removenonrelevant', [App\Http\Controllers\CompanyController::class, 'removeNonRelevant']);
    // task - 86a309hbq end

    // task - 86a3150au
    Route::get('/company/candidate_modal/{id}', [App\Http\Controllers\CompanyController::class, 'candidateProfileModal']);
    Route::post('/company/add_note/{id}', [App\Http\Controllers\CompanyController::class, 'candidateProfileSaveNote']);
    Route::post('/company/request_unmask/{id}', [App\Http\Controllers\CompanyController::class, 'candidateProfileRequest']);
    Route::get('/company/edit_search/{id}', [App\Http\Controllers\CompanyController::class, 'editSearch']);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/candidate/download-cv', [App\Http\Controllers\CandidateController::class, 'downloadPdf'])->name('candidates.downloadpdf');
    // 86a2zxgm6
    Route::get('/candidate/download-cv-employer/{user_id}', [App\Http\Controllers\CandidateController::class, 'downloadPdfEmployer'])->name('candidates.downloadpdfEmployer');
    Route::post('/candidate/upload-cv', [App\Http\Controllers\CandidateController::class, 'uploadPdf'])->name('candidates.uploadpdf');
    Route::get('/account/delete', [App\Http\Controllers\AccountController::class, 'deleteAccount'])->name('account.delete');
    Route::get('/account/sleep', [App\Http\Controllers\AccountController::class, 'sleepAccount'])->name('account.sleep');
    Route::get('/account/reset-password', [App\Http\Controllers\AccountController::class, 'resetPassword'])->name('account.resetpassword');
});
// 86a1v16g9
Route::group(['middleware' => ['auth', 'verified']], function () {
    //candidate steps goes here
    Route::get('/candidate/profile', [App\Http\Controllers\CandidateController::class, 'candidateProfile'])->name('candidateProfile');
});

Route::group(['middleware' => ['auth', 'verified', 'published']], function () {
    //candidate steps goes here
    // Route::get('/candidate/profile', [App\Http\Controllers\CandidateController::class, 'candidateProfile'])->name('candidateProfile');
    Route::get('/candidate/personal-information', [App\Http\Controllers\CandidateController::class, 'candidatestep1'])->name('candidatestep1');
    Route::get('/candidate/position-preferences', [App\Http\Controllers\CandidateController::class, 'candidatestep2'])->name('candidatestep2');
    Route::get('/candidate/education-employment', [App\Http\Controllers\CandidateController::class, 'candidatestep3'])->name('candidatestep3');
    Route::get('/candidate/education', [App\Http\Controllers\CandidateController::class, 'candidatestep4'])->name('candidatestep4');
    Route::get('/candidate/employment', [App\Http\Controllers\CandidateController::class, 'candidatestep5'])->name('candidatestep5');
    Route::get('/candidate/skills', [App\Http\Controllers\CandidateController::class, 'candidatestep6'])->name('candidatestep6');
    Route::get('/candidate/references', [App\Http\Controllers\CandidateController::class, 'candidatestep7'])->name('candidatestep7');
    Route::get('/candidate/about', [App\Http\Controllers\CandidateController::class, 'candidatestep8'])->name('candidatestep8');
    Route::get('/candidate/approval', [App\Http\Controllers\CandidateController::class, 'candidatestep9'])->name('candidatestep9');
});

Route::group(['middleware' => ['auth', 'verified', 'published']], function () {
    //candidate steps goes here
    Route::get('/company/contact-info', [App\Http\Controllers\CompanyController::class, 'companystep1'])->name('companystep1');
    Route::get('/company/company-info', [App\Http\Controllers\CompanyController::class, 'companystep2'])->name('companystep2');
    Route::get('/company/review', [App\Http\Controllers\CompanyController::class, 'companystep3'])->name('companystep3');
    Route::get('/company/choose-plan', [App\Http\Controllers\CompanyController::class, 'companystep4'])->name('companystep4');
    Route::get('/company/payment', [App\Http\Controllers\CompanyController::class, 'companystep5'])->name('companystep5');
    // Route::post('/company/payment', [App\Http\Controllers\CompanyController::class, 'companystep5'])->name('companystep5');
});

// webhook route for api transaction
Route::get('auto_renewal', [App\Http\Controllers\TransactionhookController::class, 'add_transaction']);
Route::get('ten_min', [App\Http\Controllers\TransactionhookController::class, 'update_transaction_after_tenmin']);
Route::get('cancel_yearly', [App\Http\Controllers\TransactionhookController::class, 'cancel_yearly_subscription']);

// candidate notifications every 3 months
Route::get('notify_candidate', [App\Http\Controllers\NotifyCandidates::class, 'send_notification']);
Route::get('notify_employer', [App\Http\Controllers\NotifyEmployers::class, 'send_notification']);
Route::get('/notify/candidate/sleep/{id}', [App\Http\Controllers\NotifyCandidates::class, 'sleep_account']);
Route::post('/notify/candidate/sleep/{id}', [App\Http\Controllers\NotifyCandidates::class, 'sleep_my_account']);
Route::get('/notify/candidate/keep_active/{id}', [App\Http\Controllers\NotifyCandidates::class, 'keep_active']);
Route::post('/notify/candidate/keep_active/{id}', [App\Http\Controllers\NotifyCandidates::class, 'keep_my_account_active']);


//social media register routes start
Route::get('login/{provider}', [App\Http\Controllers\SocialauthController::class, 'redirect']);
Route::get('login/{provider}/callback', [App\Http\Controllers\SocialauthController::class, 'Callback']);
Route::get('login/set_usertype/{flag}', [App\Http\Controllers\Auth\LoginController::class, 'set_usertype']);


//backend
//admin login pages
Route::get('/purplestairs/admin', [App\Http\Controllers\Backend\HomeController::class, 'purplestairsLogin'])->name('purplestairs.login');
Route::post('/admin/login', [App\Http\Controllers\Backend\HomeController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/login', [App\Http\Controllers\Backend\HomeController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [App\Http\Controllers\Backend\HomeController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin/logout', [App\Http\Controllers\Backend\HomeController::class, 'adminLogout'])->name('admin.logout');
Route::post('/banquest-webhook', [App\Http\Controllers\BanquestWebhookController::class, 'handleWebhook']);

// task - 86a2ae1fp
Route::get('/admin/2fa', [App\Http\Controllers\Backend\HomeController::class, 'two_factor']);
Route::post('/admin/2fa', [App\Http\Controllers\Backend\HomeController::class, 'admin_two_factor']);
// task - 86a2ae1fp end

Route::group(['middleware' => ['adminauth']], function () {
    Route::get('/backup/download-current', [App\Http\Controllers\Backend\HomeController::class, 'downloadCurrent'])->name('backup.downloadCurrent');
    Route::get('/zip-codes', [App\Http\Controllers\Backend\HomeController::class, 'viewZipCodes'])->name('manage.zipCode');
    Route::post('/zipcode/delete', [App\Http\Controllers\Backend\HomeController::class, 'deleteZipCodes'])->name('delete.zipCode');
    Route::get('/admin/dashboard', [App\Http\Controllers\Backend\HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    //Industries
    Route::get('industries', [App\Http\Controllers\Backend\IndustriesController::class, 'industriesList']);
    Route::get('industries/add', [App\Http\Controllers\Backend\IndustriesController::class, 'getIndustries']);
    Route::post('industries/add', [App\Http\Controllers\Backend\IndustriesController::class, 'postIndustries']);
    Route::get('industries/{id}/edit', [App\Http\Controllers\Backend\IndustriesController::class, 'getIndustriesById']);
    Route::post('industries/{id}/edit', [App\Http\Controllers\Backend\IndustriesController::class, 'postIndustriesById']);
    Route::post('industries/delete', [App\Http\Controllers\Backend\IndustriesController::class, 'delete']);
    // Route::get('industries/delete/{id}', [App\Http\Controllers\Backend\IndustriesController::class, 'delete']);

    //Search Industries
    Route::get('searchIndustries', [App\Http\Controllers\Backend\SearchController::class, 'searchIndustries']);
    Route::post('searchIndustries', [App\Http\Controllers\Backend\SearchController::class, 'searchIndustries']);

    //Area Interest
    Route::get('areaInterest', [App\Http\Controllers\Backend\AreaInterestController::class, 'areaInterestList']);
    Route::get('areaInterest/add', [App\Http\Controllers\Backend\AreaInterestController::class, 'getAreaInterest']);
    Route::post('areaInterest/add', [App\Http\Controllers\Backend\AreaInterestController::class, 'postAreaInterest']);
    Route::get('areaInterest/{id}/edit', [App\Http\Controllers\Backend\AreaInterestController::class, 'getAreaInterestById']);
    Route::post('areaInterest/{id}/edit', [App\Http\Controllers\Backend\AreaInterestController::class, 'postAreaInterestById']);
    Route::post('areaInterest/delete', [App\Http\Controllers\Backend\AreaInterestController::class, 'delete']);

    //Search Area Interest
    Route::get('searchAreaInterest', [App\Http\Controllers\Backend\SearchController::class, 'searchAreaInterest']);
    Route::post('searchAreaInterest', [App\Http\Controllers\Backend\SearchController::class, 'searchAreaInterest']);

    //Hard Skills
    Route::get('hardSkills', [App\Http\Controllers\Backend\HardSkillsController::class, 'hardSkillsList']);
    Route::get('hardSkills/add', [App\Http\Controllers\Backend\HardSkillsController::class, 'getHardSkills']);
    Route::post('hardSkills/add', [App\Http\Controllers\Backend\HardSkillsController::class, 'postHardSkills']);
    Route::get('hardSkills/{id}/edit', [App\Http\Controllers\Backend\HardSkillsController::class, 'getHardSkillsById']);
    Route::post('hardSkills/{id}/edit', [App\Http\Controllers\Backend\HardSkillsController::class, 'postHardSkillsById']);
    Route::post('hardSkills/delete', [App\Http\Controllers\Backend\HardSkillsController::class, 'delete']);

    //Search Hard Skills
    Route::get('searchHardSkills', [App\Http\Controllers\Backend\SearchController::class, 'searchHardSkills']);
    Route::post('searchHardSkills', [App\Http\Controllers\Backend\SearchController::class, 'searchHardSkills']);

    //Soft Skills
    Route::get('softSkills', [App\Http\Controllers\Backend\SoftSkillsController::class, 'softSkillsList']);
    Route::get('softSkills/add', [App\Http\Controllers\Backend\SoftSkillsController::class, 'getSoftSkills']);
    Route::post('softSkills/add', [App\Http\Controllers\Backend\SoftSkillsController::class, 'postSoftSkills']);
    Route::get('softSkills/{id}/edit', [App\Http\Controllers\Backend\SoftSkillsController::class, 'getSoftSkillsById']);
    Route::post('softSkills/{id}/edit', [App\Http\Controllers\Backend\SoftSkillsController::class, 'postSoftSkillsById']);
    Route::post('softSkills/delete', [App\Http\Controllers\Backend\SoftSkillsController::class, 'delete']);

    //Search Soft Skills
    Route::get('searchSoftSkills', [App\Http\Controllers\Backend\SearchController::class, 'searchSoftSkills']);
    Route::post('searchSoftSkills', [App\Http\Controllers\Backend\SearchController::class, 'searchSoftSkills']);

    //Languages
    Route::get('languages', [App\Http\Controllers\Backend\LanguagesController::class, 'languagesList']);
    Route::get('languages/add', [App\Http\Controllers\Backend\LanguagesController::class, 'getLanguages']);
    Route::post('languages/add', [App\Http\Controllers\Backend\LanguagesController::class, 'postLanguages']);
    Route::get('languages/{id}/edit', [App\Http\Controllers\Backend\LanguagesController::class, 'getLanguagesById']);
    Route::post('languages/{id}/edit', [App\Http\Controllers\Backend\LanguagesController::class, 'postLanguagesById']);
    Route::post('languages/delete', [App\Http\Controllers\Backend\LanguagesController::class, 'delete']);

    //Search Languages
    Route::get('searchLanguages', [App\Http\Controllers\Backend\SearchController::class, 'searchLanguages']);
    Route::post('searchLanguages', [App\Http\Controllers\Backend\SearchController::class, 'searchLanguages']);

    // task - 862k2tb2f
    Route::group(['prefix' => 'admin'], function(){
        Route::post('import', [App\Http\Controllers\Backend\CandidatesController::class, 'import'])->name('admin.candidates.import');
        // Discount Route
        Route::get('discount', [App\Http\Controllers\Backend\DiscountController::class, 'index'])->name('admin.discount');
        Route::post('discount/data', [App\Http\Controllers\Backend\DiscountController::class, 'data'])->name('admin.discount.data');

        Route::get('discount/add', [App\Http\Controllers\Backend\DiscountController::class, 'create'])->name('admin.discount.add');
        Route::post('/discount/store', [App\Http\Controllers\Backend\DiscountController::class, 'store'])->name('admin.discount.store');

        Route::get('discount/edit/{id}', [App\Http\Controllers\Backend\DiscountController::class, 'edit'])->name('admin.discount.edit');
        Route::post('discount/update/{id}', [App\Http\Controllers\Backend\DiscountController::class, 'update'])->name('admin.discount.update');

        Route::get('discount/delete/{id}', [App\Http\Controllers\Backend\DiscountController::class, 'destroy'])->name('admin.discount.delete');
        Route::get('discount/details/{id}', [App\Http\Controllers\Backend\DiscountController::class, 'details'])->name('admin.discount.details');
        Route::post('discount/employer_list/{id}', [App\Http\Controllers\Backend\DiscountController::class, 'employer_list'])->name('admin.discount.employer_list');

        // Candidates Route: task - 86a1fwwdq
        Route::get('candidates', [App\Http\Controllers\Backend\CandidatesController::class, 'index'])->name('admin.candidates');
        Route::post('candidates/data', [App\Http\Controllers\Backend\CandidatesController::class, 'data'])->name('admin.candidates.data');
        Route::post('candidates/data/filter', [App\Http\Controllers\Backend\CandidatesController::class, 'filterActive'])->name('admin.candidates.filterActive');
        Route::get('candidates/delete/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'delete'])->name('admin.candidates.delete');
        Route::get('candidates/view/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'view'])->name('admin.candidates.view');

        // task - 86a1m4ymb
        Route::get('candidates/prdelete/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'hard_delete'])->name('admin.candidates.prdelete');
        Route::get('candidate/download-cv/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'downloadPdf'])->name('admin.candidates.downloadpdf');
        Route::get('candidate/download-hidden-cv/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'downloadhiddenPdf'])->name('admin.candidates.downloadhiddenpdf');

        Route::get('candidates/add', [App\Http\Controllers\Backend\CandidatesController::class, 'add'])->name('admin.candidates.add');
        Route::get('candidates/exportCSV', [App\Http\Controllers\Backend\CandidatesController::class, 'exportCSV'])->name('admin.candidates.exportCSV');
        Route::post('candidates/create', [App\Http\Controllers\Backend\CandidatesController::class, 'create'])->name('admin.candidates.create');

        Route::get('candidates/edit/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'edit'])->name('admin.candidates.edit');
        Route::post('candidates/update/{id}', [App\Http\Controllers\Backend\CandidatesController::class, 'update'])->name('admin.candidates.update');
        // task - 86a1m4ymb end
        Route::get('candidates_intercom', [App\Http\Controllers\Backend\CandidatesController::class, 'migrate_to_intercom'])->name('admin.candidates.migrate_intercome'); // task - 86a3d37f9

        // Employers Route
        Route::get('employers', [App\Http\Controllers\Backend\EmployersController::class, 'index'])->name('admin.employers');
        Route::post('employers/data', [App\Http\Controllers\Backend\EmployersController::class, 'data'])->name('admin.employers.data');
        Route::get('employers/view/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'view'])->name('admin.employers.view');
        Route::post('employers/upsert_email/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'upsert_email'])->name('admin.employers.upsert_email'); // task - 86a2hkjbf
        Route::post('employers/downgrade_plan', [App\Http\Controllers\Backend\EmployersController::class, 'downgradePlan'])->name('admin.employers.downgrade_plan'); // task - 86a2vc3ej
        Route::get('employers_intercom', [App\Http\Controllers\Backend\EmployersController::class, 'migrate_to_intercom'])->name('admin.employers.migrate_intercome'); // task - 86a3d37f9
        Route::get('employers/prdelete/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'hard_delete'])->name('admin.employers.prdelete');
        // Employers Route
        Route::get('deleted_account', [App\Http\Controllers\Backend\DeletedaccountController::class, 'index'])->name('admin.deleted_account');
        Route::post('deleted_account/data', [App\Http\Controllers\Backend\DeletedaccountController::class, 'data'])->name('admin.deleted_account.data');
         // 86a2bf326
         // Candidates Route
         Route::get('deleted_account_candidate', [App\Http\Controllers\Backend\DeletedaccountController::class, 'candidate_list'])->name('admin.deleted_account_candidate');
         Route::post('deleted_account_candidate/data', [App\Http\Controllers\Backend\DeletedaccountController::class, 'dataCandidate'])->name('admin.deleted_account_candidate.data');
         Route::get('sleep_account_candidate', [App\Http\Controllers\Backend\SleepaccountController::class, 'candidate_list'])->name('admin.sleep_account_candidate');
         Route::post('sleep_account_candidate/data', [App\Http\Controllers\Backend\SleepaccountController::class, 'dataCandidate'])->name('admin.sleep_account_candidate.data');

        Route::get('employers/active/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'active'])->name('admin.employers.active');
        Route::get('employers/deactive/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'deactive'])->name('admin.employers.deactive');
        Route::get('employers/recurring-off/{id}', [App\Http\Controllers\Backend\EmployersController::class, 'recurringOff'])->name('admin.employers.recurringOff');

        // Abandoned Users Route   // Task #862k5c5t1
        Route::get('abandoned-users', [App\Http\Controllers\Backend\AbandonedUserController::class, 'index'])->name('admin.abandoned.users');
        Route::post('abandoned-users/data', [App\Http\Controllers\Backend\AbandonedUserController::class, 'data'])->name('admin.abandoned.users.data');


        // Invited Users Route   // Task #86a2qw2e1
        Route::get('invited-users', [App\Http\Controllers\Backend\InvitedUserController::class, 'index'])->name('admin.invited.users');
        Route::post('invited-users/data', [App\Http\Controllers\Backend\InvitedUserController::class, 'data'])->name('admin.invited.users.data');
        Route::get('invited/active/{id}', [App\Http\Controllers\Backend\InvitedUserController::class, 'active'])->name('admin.invited.active');

        // Sleep Account // task - 86a0unpr7
        Route::get('sleep_account', [App\Http\Controllers\Backend\SleepaccountController::class, 'index'])->name('admin.sleep_account');
        Route::post('sleep_account/data', [App\Http\Controllers\Backend\SleepaccountController::class, 'data'])->name('admin.sleep_account.data');
        Route::get('sleep_account/activate/{id}', [App\Http\Controllers\Backend\SleepaccountController::class, 'activate'])->name('admin.sleep_account.activate');
    });


});

// Cron job routes test
Route::get('/valid-us-zip', [App\Http\Controllers\PagesController::class, 'validUsZip']);
Route::get('/search-match-user', [App\Http\Controllers\PagesController::class, 'searchMatchUser']);
Route::get('/search-new-match', [App\Http\Controllers\PagesController::class, 'searchNewMatch']);
Route::get('/update-charges', [App\Http\Controllers\PagesController::class, 'updateCharges']);
Route::get('/reminder-email-to-candidate', [App\Http\Controllers\PagesController::class, 'reminderEmailToCandidate']);
Route::get('/reminder-email-to-candidate-3days', [App\Http\Controllers\PagesController::class, 'reminderEmailToCandidate3Days']);
Route::get('/reminder-email-to-candidate-6days', [App\Http\Controllers\PagesController::class, 'reminderEmailToCandidate6Days']);
Route::get('/language-set', [App\Http\Controllers\PagesController::class, 'languageSet']);
