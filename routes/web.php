<?php

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
    return view('welcome');
});

Route::get('/blank', function () {
    return view('blank');
});


Auth::routes();

Route::group(['middleware' => ['auth']],
    function ()
{
    Route::get('/home', 'HomeController@index')->name('home');


    #SAVINGS DATE
    Route::get('display/savings_date', 'SavingsDateController@displaySavingsDate');
    Route::POST('store/savings_date', 'SavingsDateController@storeSavingsDate');
    Route::POST('edit/savings_date/{id}', 'SavingsDateController@editSavingsDate');
    Route::POST('destroy/savings_date/{id}', 'SavingsDateController@destroySavingsDate');

    #SAVINGS
    Route::get('group/savings', 'SavingsController@displayGroupSavings');
    Route::POST('store/savings/{id}', 'SavingsController@storeSavings');
    Route::POST('edit/savings/{id}', 'SavingsController@editSavings');
    Route::POST('destroy/savings/{id}', 'SavingsController@destroySavings');

    
    #LOANS
    Route::get('loans/active', 'LoansController@displayActiveLoans');
    Route::POST('loans/approved/{application_id}', 'LoansController@approvedLoanApplication');
    Route::get('loans/applications', 'LoansController@displayLoanApplications');
    Route::resource('loans', 'LoansController'); 



    #LOGS
    Route::get('logs/savings', 'LogsController@savings');
});#END OF MIDDLEWARE AUTH       

