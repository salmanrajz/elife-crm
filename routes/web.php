<?php

use App\audio_recording;
use App\choosen_number;
use App\lead_sale;
use App\remark;
use App\verification_form;
use Illuminate\Support\Facades\Route;
use App\Events\MyEvent;
use App\numberdetail;
use App\status_code;
use App\customer_notification;
use App\User;
use Carbon\Carbon;
// MyEvent2
// use app\Events\MyEvent2;
// use app\Notifications\OneWeekAfterNotice;
use Illuminate\Support\Facades\Auth;
use Spatie\MailTemplates\TemplateMailable;
// use Thomasjohnkane\Snooze\Models\ScheduledNotification;
// use Request;
// use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use  Spatie\Permission\Traits\HasRoles;


// MyEvent
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

// Route::get('users/{id}', function ($id) {

// });
Route::get('DailyActivation', 'ReportController@DailyActivation')->name('my.log');
Route::get('MonthlyTarget', 'ReportController@MonthlyTarget')->name('my.target');

Route::get('phpversion', function () {
    phpinfo();

    // event(new MyEvent2('hello world'));
    // return view('dashboard.test');

});


Route::get('/feedback', function () {
    return view('auth.feedback');
    return $posts = lead_sale::whereDate('created_at', Carbon::today())->get();

});
Route::get('/today', function () {
    // return view('auth.feedback');
    $posts = lead_sale::select('lead_sales.*')
    // ->whereDate('updated_at', Carbon::today())->get();
    ->where('status', '1.18')->get();
    foreach($posts as $k => $value){
        // echo $k . '<br>';
        // echo $value->id . '<br>';
        $p = lead_sale::findorfail($value->id);
        $p->status = '1.17';
        $p->remarks = 'Time Out, Please Proceed Next Day Immediately';
        $p->save();
    }

});
Route::get('/annotate', 'AnnotationController@displayForm');
Route::post('/annotate', 'AnnotationController@annotateImage');


Route::get('verlead', function () {
    // $k
    // SELECT a.status,b.status, a.customer_name FROM `lead_sales` a INNER JOIN verification_forms b on b.lead_no = a.id where a.status = '1.07'
    return  $k = verification_form::select('lead_sales.id','lead_sales.status','verification_forms.status','lead_sales.customer_name')
        ->Join(
            'lead_sales',
            'lead_sales.id',
            '=',
            'verification_forms.lead_no'
        )
        ->where('lead_sales.status','1.04')
        // ->where('verification_forms.status','1.07')
        ->get();
    foreach($k as $kk){
        // echo $kk->id . '<br>';
        $p = lead_sale::where('id',$kk->id)->update([
            'status' => '1.04'
        ]);
    }

});



Route::get('/', function () {
    // return view('welcome');
    return redirect(route('admin.login'));
});
Route::get('/role-system', function () {
    // Role::create(['name'=> 'Saler']);
    // Permission::create(['name'=> 'Data Entry']);
});
Route::get('/logout', function () {
    // return view('welcome');
    Auth::logout();
    return redirect(route('login'));
});
// Route::get('users/{id}', function ($id) {

// });
// Route::get('Online', 'HomeController@Online');
// Route::post('OnlineStatus', 'AjaxController@OnlineStatus')->name('Online.Status.Ajax');
// Route::get('number-system-{slug}', 'AjaxController@numbersystem')->name('number-system-ttf');
// Route::get('ClientIp', 'AjaxController@ClientIp');
// Route::get('ajaxRequest', 'AjaxController@ajaxRequest');
Route::post('ajaxRequest', 'AjaxController@ajaxRequestPost')->name('ajaxRequest.post');
Route::post('leadrejectedelife', 'MainController@leadrejectelife')->name('elife.lead.rejected');
// Route::post('ChatRequest', 'AjaxController@ChatPost')->name('chat.post');
// Route::post('ajaxRequest1', 'AjaxController@ajaxRequestItPost')->name('ajaxRequest.itpost');
Route::post('PlanType', 'AjaxController@PlanType')->name('ajaxRequest.PlanType');
// Route::post('ajaxRequest2', 'AjaxController@ajaxRequestItPlan')->name('ajaxRequest.itplan');
// Route::post('ReportRequest', 'AjaxController@report')->name('ajaxRequest.report');
Route::post('CheckPackageName', 'AjaxController@CheckPackageName')->name('ajaxRequest.CheckPackageName');
Route::post('checkNumData', 'AjaxController@checkNumData')->name('ajaxRequest.checkNumData');
// Route::post('ChannelReport', 'AjaxController@ChannelReport')->name('ajaxRequest.ChannelReport');
// Route::post('SaleReportRequest', 'AjaxController@SaleReport')->name('ajaxRequest.SaleReport');
// Route::post('SaleDtlReportRequest', 'AjaxController@DtlReport')->name('ajaxRequest.DtlReport');
// Route::post('ReportByDay', 'AjaxController@ReportByDay')->name('ajaxRequest.ReportByDay');
// Route::post('OTP', 'AjaxController@OTP')->name('ajaxRequest.OTP');
// Route::post('NumberByType', 'AjaxController@NumberByType')->name('ajaxRequest.NumberByType');
// Route::post('NumberByType2', 'AjaxController@NumberByType2')->name('ajaxRequest.NumberByType2');
// Route::post('ReservedNum', 'AjaxController@ReservedNum')->name('ajaxRequest.ReservedNum');
// Route::post('BookNUm', 'AjaxController@BookNum')->name('ajaxRequest.BookNum');
// Route::post('RevNum', 'AjaxController@RevNum')->name('ajaxRequest.RevNum');
// Route::post('RemoveRevive', 'AjaxController@RevNum2')->name('Remove.RevNum');
// Route::post('HoldNum', 'AjaxController@HoldNum')->name('ajaxRequest.HoldNum');
// Route::post('AssignLead', 'AjaxController@AssignLead')->name('ajaxRequest.AssignLead');
// Route::post('VerifyNum', 'AjaxController@VerifyNum')->name('ajaxRequest.VerifyNum');
// Route::post('VerifyNum2', 'AjaxController@VerifyNum2')->name('ajaxRequest.VerifyNum2');
// Route::post('VerifyNum22', 'AjaxController@VerifyNum22')->name('ajaxRequest.VerifyNum22');
// Route::post('Revert', 'AjaxController@Revert')->name('ajaxRequest.Revert');
// Route::post('AcceptLead', 'AjaxController@AcceptLead')->name('ajaxRequest.AcceptLead');
// Route::post('Reject', 'AjaxController@reject')->name('ajaxRequest.Reject');
// Route::post('ManagerReject', 'AjaxController@ManagerReject')->name('ajaxRequest.ManagerReject');
// Route::post('NumberActivation', 'AjaxController@NumberActivation')->name('ajaxRequest.NumberActivation');
// Route::get('/skill-auto-complete', 'AjaxController@dataAjax')->name('skill-auto-complete');
// Route::get('vision-name', 'AjaxController@vision_name');
// Route::get('vision', 'AjaxController@vision');
// Route::get('DailyReport', 'ReportController@DailyReport')->name('daily.report');
// Route::get('MonthlyActivation', 'ReportController@MonthlyActivation')->name('monthly-activation');
// Route::get('vision-sr', 'AjaxController@vision_sr');
// Route::get('CordinationFollow', 'AjaxController@CordinationFollow')->name('cordination.follow');
// Route::get('ActivationFollow', 'AjaxController@ActivationFollow')->name('activation.follow');
// Route::get('AllRemovedNumber', 'AjaxController@AllRemovedNumber')->name('all.removed');

// Route::get('MyLog', 'AjaxController@MyLog')->name('my.log');
Route::post('CheckPendingLead', 'AjaxController@CheckPendingLead')->name('ajaxRequest.CheckPendingLead');
Route::post('ElifePlan', 'AjaxController@ElifePlan')->name('elife.plan');
Route::get('ElifeNoAnswer', 'AjaxController@ElifeNoAnswer')->name('elife.log.NoAnswer');
Route::post('elife-addon', 'ElifeController@elifeaddon')->name('elife.addon');
Route::get('ViewElifeUser', 'AjaxController@ViewElifeUser')->name('elife.log.user');

Route::post('ocr', 'AjaxController@OCR')->name('ocr.submit');
Route::post('ocr-sr', 'AjaxController@ocr_sr')->name('ocr-sr.submit');
Route::post('ocr-name', 'AjaxController@ocr_name')->name('ocr-name.submit');
// Route::post('LeadReAssign', 'AjaxController@LeadReAssign')->name('lead.re-assign');
// Route::post('activate-lead', 'ActivationController@ActiveNew')->name('activate-lead');
// Route::post('activate-elife-lead', 'ActivationController@ActiveElife')->name('activate-elife-lead');
Route::post('activate-elife-plan', 'ActivationController@ActiveElifePlan')->name('activate-elife-plan');
Route::post('reject-elife-plan', 'ActivationController@RejectElifePlan')->name('reject-elife-plan');

// //
// //
Route::prefix('admin')->group(function () {
//     // Route::get('test', function () {
//     //     // event(new App\Events\MyEvent('Someone'));
//     //     event(new MyEvent('hello world'));
//     //     return "Event has been sent!";
//     // });
//     //

//     //
//     Route::get('/manage-coordination/{id}', 'AjaxController@manage_cordinator')->name('manage-cordination');
//     Route::get('/emirate-proceed/{id}', 'CoordinaterController@emirate')->name('emirate-cordination');
//     Route::get('/emirate-proceed-assigned/{id}', 'CoordinaterController@emirate_assigned')->name('emirate-cordination-proceed');
//     //
    Route::get('/import_excel', 'ImportExcelController@index')->name('import_excel')->middleware('role:Admin|superAdmin');
    Route::get('/import-number-bank', 'ImportExcelController@index_elife')->name('import_elife');
    Route::get('/assign-number-bank', 'ImportExcelController@assign_number_bank')->name('assign.number.bank');
    Route::post('/import_excel/import', 'ImportExcelController@import')->name('import.excel')->middleware('auth');
    Route::post('/import_elife/import', 'ImportExcelController@import_elife')->name('import.excel.elife')->middleware('auth');
    Route::post('/elife-datauploader-bank', 'ImportExcelController@ElifeDataUploader')->name('elife-datauploader-bank')->middleware('auth');
    Route::post('/elife-lead-bank', 'ImportExcelController@ElifeLeadBank')->name('elife-lead-bank')->middleware('auth');
    Route::get('ElifeLog', 'ImportExcelController@ElifeLog')->name('elife.log');

//     //
    Route::post('/bulk_importer/assigner', 'ImportExcelController@assigner')->name('bulk.assigner')->middleware('auth');
    Route::post('/bulk_importer/assigner-users', 'ImportExcelController@assigner_users')->name('bulk.assigner.users')->middleware('auth');
    Route::post('/bulk_importer/assigner-multiple', 'ImportExcelController@assigner_multiple')->name('bulk.assigner.multiple')->middleware('auth');

//     Route::get('/myactive', 'ActivationController@myactive')->name('myactive')->middleware('auth');
//     // Route::get('/target-assigner', 'TargetAssignerManagerController@myactive')->name('myactive')->middleware('auth');
//     //

//     //
//     // Route::get('fireEvent', function () {
//     //     event(new MyEvent('Hello World'));
//     // });
    Route::get('/', 'HomeController@index')->name('admin.dashboard');
    Route::resource('/elife-log', 'ElifeLogController')->middleware('auth');
    Route::resource('/agency', 'KioskIdController')->middleware('auth');
    Route::resource('/lead', 'LeadSaleController')->middleware('auth');
    Route::resource('/partner', 'ChannelPartnerController')->middleware('auth');
    Route::post('/elife-lead', 'MainController@elife_telesale')->name('elife.lead.submit');
    Route::post('/elife-direct', 'MainController@elife_dd')->name('elife.direct.submit');
    Route::post('/postpaid-submit', 'MainController@postpaid_telesale')->name('postpaid.submit');
    Route::post('/postpaid-direct', 'MainController@postpaid_direct_telesale')->name('postpaid.direct.submit');
    Route::post('/prepaid-direct', 'MainController@prepaid_sale')->name('prepaid.submit');
    Route::post('/control-direct', 'MainController@control_line_submit')->name('control.submit');
    Route::post('/billing-direct', 'MainController@billing_sale')->name('billing.submit');
    Route::get('/MyWallet', 'MainController@MyWallet')->name('MyWallet');
//     Route::get('/days', 'HomeController@days_test');
    Route::get('/feedback-data', 'HomeController@feedback')->name('admin.feedback');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
//     // Route::get('/number-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login.submit');
//     // Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::resource('/plan', 'PlanController')->middleware('role:Admin|Superadmin');
    Route::resource('/elife', 'ElifePlanController')->middleware('role:Admin|Superadmin');
    Route::resource('/BillingType', 'BillingTypeController')->middleware('role:Admin|Superadmin|Manager');
    Route::resource('/wallet', 'UserWallerController')->middleware('role:Admin|Superadmin|Manager|General-Manager');
    Route::resource('/elife-addon', 'AddonController')->middleware('role:Admin|Superadmin');
    Route::resource('/call-center', 'CallCenterController')->middleware('role:Admin|Superadmin');
    Route::resource('/emirate', 'EmirateController')->middleware('role:Admin|Superadmin');
    Route::resource('/verification', 'VerificationFormController');
    Route::resource('/multi-sale', 'MultiSaleController')->middleware('auth');
    Route::resource('/lead-location', 'LeadLocationController');
    Route::resource('/IT-product', 'ItProductsController')->middleware('role:Admin|Superadmin');
    Route::resource('/imei', 'ImeiListController')->middleware('role:Admin|Superadmin');
    Route::resource('/IT-Plan', 'ItproductplansController')->middleware('role:Admin|Superadmin');
    Route::resource('/Manager-target', 'TargetAssignerManagerController')->middleware('role:Admin|Superadmin');
    Route::resource('/user-target', 'TargetAssignerUserController')->middleware('auth');
    Route::get('MasterLogin/{id}', 'MasterController@MasterLogin')->name('master.login');
    Route::get('add-saler-data', 'DataController@add_saler_data')->name('saler.entry');
    Route::get('view-saler-data', 'DataController@saler_data')->name('saler.data');
    Route::post('saler-store', 'DataController@saler_store')->name('saler.store');

    // Route::resource('/old-data', 'OldDataController');
    Route::get('/user', 'UserController@index')->name('user-index')->middleware('role:Admin|Superadmin|Manager');
    Route::get('/my-agent', 'UserController@myagent')->name('my.agent')->middleware('role:Admin|Superadmin|Manager');
    Route::get('/user/create', 'UserController@create')->name('user.create')->middleware('role:Admin|Superadmin|Manager');
    Route::post('/user', 'UserController@store')->name('admin.user.store')->middleware('role:Admin|Superadmin|Manager');
    Route::post('/users/{id}', 'UserController@update')->name('admin.user.update')->middleware('role:Admin|Superadmin|Manager');
    Route::get('/user/{id}', 'UserController@destroy')->name('user.destroy')->middleware('role:Admin|Superadmin|Manager');
    Route::get('/user-edit/{id}', 'UserController@edit')->name('user.edit')->middleware('role:Admin|Superadmin|Manager');
    Route::get('view-lead/{id}', 'LeadController@view_lead')->name('view.lead')->middleware('role:Admin|Superadmin|Manager');
    Route::get('agency-billing/{id}', 'BillingController@AgencyBilling')->name('AgencyBilling')->middleware('role:Admin|Superadmin|Manager');
    Route::post('BillingAmountAdd', 'BillingController@BillingAmountAdd')->name('BillingAmountAdd')->middleware('role:Admin|Superadmin|Manager');
    Route::post('BillingAmount', 'BillingController@BillingAmount')->name('BillingAmount')->middleware('auth');

    Route::get('mygroupleads/{id}/channel/{channel}', [
        'as' => 'showCampaignProductDetails', 'uses' => 'ManagerController@ManagerController'
    ]);
    Route::get('ManageRecording/{id}/channel/{channel}', [
        'as' => 'showCampaignProductDetailsManageRecording', 'uses' => 'ManagerController@ManageRecording'
    ]);
    Route::get('agentlead/{id}/channel/{channel}/leadid/{leadid}/status/{status}', [
        'as' => 'AgentLeadData', 'uses' => 'ManagerController@AgentLeadData'
    ]);
    Route::get('attend-lead/{id}/channel/{channel}/leadid/{leadid}', [
        'as' => 'AttendLead', 'uses' => 'ManagerController@attend_lead'
    ]);
    Route::get('AddRecording/{id}/channel/{channel}/leadid/{leadid}', [
        'as' => 'AddRecording', 'uses' => 'ManagerController@AddRecording'
    ]);
    Route::post('/elife-assigned', 'MainController@elife_assigned')->name('elife.assigned.submit');
    Route::post('/elife-active', 'MainController@elife_active')->name('elife.active.submit');
    Route::post('/elife_followup', 'MainController@elife_active')->name('elife.follow.submit');
    Route::post('/elife-reject', 'MainController@elife_followup')->name('elife.reject.submit');
    Route::post('/elife-complete', 'MainController@elife_complete')->name('elife.complete.submit');
    Route::post('/attach_recording', 'MainController@attach_recording')->name('attach.recording');
    Route::post('/attach_recording_nonvalidate', 'MainController@attach_recording_nonvalidate')->name('attach.recording.nonvalidate');
    //
    //
    //MY TEAM START
    Route::get('myteam', 'TeamController@myteam')->name('myteam')->middleware('role:Team-Leader');
    Route::get('team-member/{slug}', 'TeamController@myteamid')->name('myteamid')->middleware('role:Team-Leader');
    Route::get('TeamChannel/{id}/channel/{channel}/', [
        'as' => 'TeamChannel', 'uses' => 'TeamController@TeamChannel'
    ]);
    Route::get('ShowTeamMemberLead/{id}/channel/{channel}/agent/{agent}', [
        'as' => 'ShowTeamMemberLead', 'uses' => 'TeamController@ShowTeamMemberLead'
    ]);
    //
    // Route::get('ShowTeamMemberLead/{id}/channel/{channel}/agent/{leadid}/status/{status}', [
        // 'as' => 'ShowTeamMemberLead', 'uses' => 'TeamController@ShowTeamMemberLead'
    // ]);
    //MY TEAM END




});
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
//



// //Reoptimized class loader:
// Route::get('/optimize', function() {
//     $exitCode = Artisan::call('optimize');
//     return '<h1>Reoptimized class loader</h1>';
// });

// //Route cache:
// Route::get('/route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return '<h1>Routes cached</h1>';
// });

// //Clear Route cache:
// Route::get('/route-clear', function() {
//     $exitCode = Artisan::call('route:clear');
//     return '<h1>Route cache cleared</h1>';
// });

// //Clear View cache:
// Route::get('/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return '<h1>View cache cleared</h1>';
// });

// //Clear Config cache:
// Route::get('/config-cache', function() {
//     $exitCode = Artisan::call('config:cache');
//     return '<h1>Clear Config cleared</h1>';
// });
