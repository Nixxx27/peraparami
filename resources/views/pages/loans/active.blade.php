
@extends('adminlte::page')

@section('title', 'Active Loans')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection

@section('content_header')
    <h1>Active Loans</h1>
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
                @include('errors.with_error')
                @include('errors.success')
            </div>
    <div class="col-md-12">
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            {{-- <th>Loan Date</th> --}}
                            <th>Approval Date</th>
                            <th>Loaned Amount</th>
                            <th>Balance</th>
                            {{-- <th>Approver</th> --}}
                            <th>Maturity Date</th>
                            <th colspan="2" style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{ucwords($loan->user->name)}}</td>
                            {{-- <td>{{$loan->loan_date->format('M d Y D h:i:s A')}}</td> --}}
                            <td>{{$loan->approval_date->format('M d Y D')}}</td>
                            <td style="font-size: 16px; font-weight: bold">&#8369;{{ number_format($loan->approved_amount,2) }}</td>
                            <td>&#8369;{{ number_format($loan->balance,2) }}</td>
                            {{-- <td>{{ucwords($loan->approver->name)}}</td> --}}
                            <td>{{$loan->maturity_date->format('M d Y D ')}}</td>
                            <td><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#approved-application-{{$loan->id}}"><i class="fa fa-check" aria-hidden="true"></i> View</button></td>
                            <td><button class="btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Disapproved</button></td>
                        </tr>

                        <!-- Approved Modal -->
                    <div id="approved-application-{{$loan->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                        {{ Form::open(array('url' => 'loans/approved/' . $loan->id ,'method' => 'POST')) }}
                                       
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Approved &#8369;{{ number_format($loan->amount,2) }} Loan of {{strtoupper($loan->user->name)}} ?</h4>
                                </div>
                                <div class="modal-body">
                                <label>Approved Amount </label>
                                <SPAN style="font-size: 16px; font-weight: bold">&#8369;</SPAN> 
                                <input type="text" name="approved_amount" value="{{$loan->amount}}" id="approved-amount-{{$loan->id}}" onkeyup="checkApprovedAmount({{$loan->amount}},{{$loan->id}})" style="height: 50px; width: 250px border: 1px solid green; padding: 2px; font-size: 16px">
                                <div id="note-{{$loan->id}}" style="color: red; font-size: 12px"></div>
                                <hr>
                                <label for="">ADD REMARKS</label><br>
                                <textarea name="remarks"  id="" cols="80" rows="4"></textarea>
                            </div>
                                <div class="modal-footer">
                                <button class="btn btn-success" onclick="return confirm('Are you sure you want to Approved this Loan?')"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Approved</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                {!! Form::close() !!}
                                    
                            </div>
                        
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
    </div><!--col-md-10-->
</div><!--row-->
    
@endsection

@section('js')

@endsection