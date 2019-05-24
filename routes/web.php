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


use App\Task;
use App\Category;
use Illuminate\Http\Request;

/**
 * 顯示所有任務
 */
Route::get('/{sort?}', function ($sort = 'asc') {
  if($sort=='asc')
  $tasks = Task::orderBy('sort','asc')->get();
  else if($sort=='desc') {
  $tasks = Task::orderBy('sort','desc')->get();
  }

  $categories = Category::all();
    return view('tasks',[
      'tasks' => $tasks,
      'categories' => $categories
 
    ]);
});

/**
 * 增加新的任務
 */
 Route::post('/task', function (Request $request) {
   $validator = Validator::make($request->all(), [
     'name' => 'required|max:255',
     'sort' => 'required|max:255',
   ]);

   if ($validator->fails()) {
       return redirect('/')
           ->withInput()
           ->withErrors($validator);
   }

   $task = new Task;
   $task->name = $request->name;
   $task->category_id = $request->class;
   $task->sort = $request->sort;
   $task->save();

   return redirect('/');

 });



/**
 * 刪除一個已有的任務
 */
Route::delete('/task/{id}', function ($id) {
  Task::findOrFail($id)->delete();

 return redirect('/');
});
