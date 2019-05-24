@extends('app')

@section('content')


  <div class="panel panel-default">
    <div class="panel-body">
      <!-- 顯示驗證錯誤 -->
      @include('errors')


      <!-- 新任務的表單 -->
      <form action="/task" method="POST" class="form-horizontal">
        <!-- 避免csrf攻擊-->
        {{ csrf_field() }}

        <!-- 任務名稱 -->
        <div class="form-group">
          <label for="task" class="col-sm-3 control-label">Task</label>
          <div class="col-sm-3">
            <input type="text" name="name" id="task-name" class="form-control">
          </div>


          <div class="col-sm-1">
  <input type="text" name="sort" id="task-sort" class="form-control" placeholder="sort">
  </div>  

  <div class="col-sm-2">
  <select class="form-control" id="class" name="class">
    @foreach($categories as $category)
    <option value="{{ $category->id}}">{{ $category->type_name}}</option>
   @endforeach
  </select>

  </div>





        </div>

        

        <!-- 增加任務按鈕-->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success">Add Task</button>

            <a href="/asc" class="btn btn-default">順序</a>
            <a href="/desc" class="btn btn-default">倒序</a>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- 目前任務 -->
  @if(count($tasks)>0)

  @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      Current Task
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <th>ID</th>
          <th>Task</th>
          <th>Category_id</th>
          <th>Sort</th>
          <th>種類</th>

          <th>CreatedTime</th>
        </thead>
        <tbody>
          @foreach($tasks as $key => $task)
            <tr>
              <td>{{ $task->id }}</td>
              <td>{{ $task->name }}</td>
              <td>{{ $task->category_id }}</td>
              <td>{{ $task->sort }}</td>
              <td>{{ $task->category->type_name }}</td>
         
        
 
      
     
              <td>{{ $task->created_at }}</td>
              <td>

                <form action="/task/{{ $task->id }}" method="post">
                  <button type="submit" class="btn btn-danger">Delete</button>
                  {{ csrf_field() }}
                  {{method_field('DELETE')}}
                </form>


              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
