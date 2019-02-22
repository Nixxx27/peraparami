
@extends('adminlte::page')

@section('title', 'Savings Collection Date')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection


@section('content_header')
    <h1>Savings Collection</h1>
@endsection

@section('content')
<hr>
 <div class="row">
    <div class="col-md-12">
        @include('errors.with_error')
        @include('errors.success')
    </div>
    
    <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDate">Add Savings Collection Date</button>
    </div>
    <div class="col-md-offset-1 col-md-6" style="margin-top: 20px;">
            <table class="table table-striped table-bordered">
                <thead>
                   <tr>
                       <th>DATE</th>
                       <th></th>
                       <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savings_date as $date)
                        <tr>
                            <td style="font-size: 16x; font-weight: bold">{{$date->date->format('M-d-Y D')}}</td>
                       
                            <td style="text-align:center">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDate-{{$date->id}}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
   

                            <!-- Edit Modal -->
                            <div id="editDate-{{$date->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Savings Collection Date</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ Form::open(array('url' => 'edit/savings_date/' . $date->id,'method' => 'POST')) }}
                                                <label for="">CHOOSE NEW DATE</label>
                                        <input type="date" class="form-control" name="date" id="date" value="{{$date->date->format('Y-m-d')}}">
                                            </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                
                                    </div>
                                </div><!--modal-->
                            </td>
                      
                            <td style="align: left">
                                {{ Form::open(array('url' => 'destroy/savings_date/' . $date->id,'method' => 'POST')) }}
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Date?')" title="Delete {{ $date->date }}">
                                  <span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span>
                                 </button>
                                {!! Form::close() !!}
                           </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
    </div><!--div12-->

</div><!--row-->
  
<!-- Add Modal -->
<div id="addDate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Savings Collection Date</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('name'=>'add_date','id'=>'add_date','action'=>'SavingsDateController@storeSavingsDate')) !!}
            <label for="">CHOOSE DATE</label>
            <input type="date" class="form-control" name="date" id="date">
        </div>
      <div class="modal-footer">
          <button class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>



@endsection

@section('js')

@endsection