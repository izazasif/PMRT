<?php

use Illuminate\Support\Facades\Route;
use App\Models\Technologies;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[App\Http\Controllers\HomeController::class,'index'])->name('login');
Route::post('/',[App\Http\Controllers\HomeController::class,'login'])->name('authenticate');


Route::middleware(['auth'])->group(function () {

    Route::get('/logout',[App\Http\Controllers\HomeController::class,'logout'])->name('logout');
    // projects 
    Route::get('/projects',[App\Http\Controllers\ProjectsController::class,'index'])->name('project.index');
    Route::get('/create_projects',[App\Http\Controllers\ProjectsController::class,'create'])->name('project.create');
    Route::post('/create_projects',[App\Http\Controllers\ProjectsController::class,'store'])->name('project.store');
    Route::get('/fetch-name/{id}', [App\Http\Controllers\ProjectsController::class,'fetchName'])->name('project.name');
    Route::get('/stage', [App\Http\Controllers\ProjectsController::class,'stage'])->name('project.stage');
    Route::post('/stage', [App\Http\Controllers\ProjectsController::class,'stage_store'])->name('project.stage_store');
    Route::get('/stage_delete/{id}', [App\Http\Controllers\ProjectsController::class,'stage_delete'])->name('project.stage_delete');
    Route::get('/view/{userID}',[App\Http\Controllers\ProjectsController::class,'view_pro_info'])->name('project.view_pro_info');
    //user
    Route::get('/user_list',[App\Http\Controllers\UserController::class,'index'])->name('user.index');
    Route::get('/create_user',[App\Http\Controllers\UserController::class,'create'])->name('user.create');
    Route::post('/create_user',[App\Http\Controllers\UserController::class,'store'])->name('user.store');
    Route::get('/edit/{id}',[App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
    Route::post('/edit',[App\Http\Controllers\UserController::class,'update'])->name('user.update');
    Route::get('/status/{id}',[App\Http\Controllers\UserController::class,'status'])->name('user.status');
   
    //update profile

    Route::get('/update_profile/{id}',[App\Http\Controllers\UserController::class,'update_profile'])->name('user.update_profile');
    Route::post('/update_profile',[App\Http\Controllers\UserController::class,'update_profile_store'])->name('user.update_profile_store');

    Route::post('/remove-item/{tech}/{userId}', function ($tech,$userId) {
        $data = Technologies::where('name',$tech)->first();
        DB::table('developer__skills')->where('technology_id',$data->id)->where('developer_id', $userId)->delete();
        return response()->json(['success' => true]);
      });
      Route::post('/remove-project/{dev_name}/{id}', function ($dev_name,$id) {
        $data = User::where('name',$dev_name)->first();
        DB::table('project__developer__assignments')->where('developer_id',$data->id)->where('project_id', $id)->delete();
        return response()->json(['success' => true]);
      });

    //assign project developer
    Route::get('/assign_developer/{id}', [App\Http\Controllers\ProjectsController::class,'assign'])->name('project.assign');
    Route::post('/assign_developer', [App\Http\Controllers\ProjectsController::class,'assign_store'])->name('project.assign_store');
    Route::get('/project_edit/{id}', [App\Http\Controllers\ProjectsController::class,'project_edit'])->name('project.edit');
    Route::post('/project_edit', [App\Http\Controllers\ProjectsController::class,'project_edit_store'])->name('project.edit_store');

    //report
    Route::get('/report', [App\Http\Controllers\ReportController::class,'index'])->name('report.index');
    Route::get('/developer_all_report', [App\Http\Controllers\ReportController::class,'developer_all_report'])->name('report.developer_all_report');
    Route::get('/write_report/{id}', [App\Http\Controllers\ReportController::class,'create'])->name('report.create');
    Route::post('/write_report}', [App\Http\Controllers\ReportController::class,'store'])->name('report.store');
    Route::get('/report/{id}/edit/{developer_id}', [App\Http\Controllers\ReportController::class,'edit_dev'])->name('report.edit_dev');
    Route::post('/edit_dev_save', [App\Http\Controllers\ReportController::class,'edit_dev_save'])->name('report.edit_dev_save');

    Route::get('/leader/show', [App\Http\Controllers\ReportController::class,'show'])->name('report.show');
    Route::get('/leader_edit/{id}', [App\Http\Controllers\ReportController::class,'edit'])->name('report.edit');
    Route::post('/leader', [App\Http\Controllers\ReportController::class,'update'])->name('report.update');
    Route::get('/report/show', [App\Http\Controllers\ReportController::class,'report_show'])->name('report.report_show');
    Route::get('/report/projects', [App\Http\Controllers\ReportController::class,'project_show'])->name('report.project_show');
    //sorting 
    Route::post('/sort', [App\Http\Controllers\ReportController::class,'report_sort'])->name('report.report_sort');
    Route::get('/sort', [App\Http\Controllers\ReportController::class,'report_reset'])->name('report.report_reset');
    //history
    Route::get('/history', [App\Http\Controllers\ReportController::class,'history'])->name('report.history');
    Route::post('/history', [App\Http\Controllers\ReportController::class,'history_report'])->name('report.history_report'); 
    Route::get('/history_reset', [App\Http\Controllers\ReportController::class,'report_reset1'])->name('report.report_reset1');   
    //developer_technology_and_role
    Route::get('/project', [App\Http\Controllers\UserController::class,'techno']);
    Route::get('/technology', [App\Http\Controllers\UserController::class,'technology'])->name('developer.technology');
    Route::post('/technology', [App\Http\Controllers\UserController::class,'technology_store'])->name('developer.technologyStore');
    Route::get('/technology_delete/{id}', [App\Http\Controllers\UserController::class,'technology_delete'])->name('developer.technology_delete');
    Route::get('/role', [App\Http\Controllers\UserController::class,'role'])->name('developer.role');
    Route::post('/role', [App\Http\Controllers\UserController::class,'role_store'])->name('developer.role_store');
    Route::get('/role_delete/{id}', [App\Http\Controllers\UserController::class,'role_delete'])->name('developer.delete');
    //settings 
    Route::get('/pass_change', [App\Http\Controllers\UserController::class,'pass_change'])->name('developer.pass_change');
    Route::post('/pass_change', [App\Http\Controllers\UserController::class,'pass_store'])->name('developer.pass_store');
});