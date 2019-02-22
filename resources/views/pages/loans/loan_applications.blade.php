
@extends('adminlte::page')

@section('title', 'Loan Applications')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
        th{
            background: #00a65a;
            color: white;
        }
    </style>
@endsection

@section('content_header')
    <h1>Loan Applications </h1>
    <hr>
    <span style="font-size: 16px; font-weight: bold; padding-top: 200px">Available Cash on hand &#8369;{{ number_format($loanbleAmount,2) }}</span>
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
                            <th>Loan Application Date</th>
                            <th>Member Name</th>
                            <th>Amount</th>
                            <th>Loan Needed Date</th>
                            <th>Remarks</th>
                            <th colspan="2" style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loan_applications as $loan)
                        <tr>
                            <td>{{$loan->created_at->format('M d Y D h:i:s A')}}</td>
                            <td>{{ucwords($loan->user->name)}}</td>
                            <td style="font-size: 16px; font-weight: bold">&#8369;{{ number_format($loan->amount,2) }}</td>
                            <td>{{$loan->needed_date->format('M d Y D')}}</td>
                            <td>{{$loan->remarks}}</td>
                            <td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#approved-application-{{$loan->id}}"><i class="fa fa-check" aria-hidden="true"></i> Approved</button></td>
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
                                <label>APPROVED AMOUNT : </label>
                                <SPAN style="font-size: 16px; font-weight: bold"> &#8369;</SPAN> 
                                <input type="text" name="approved_amount" value="{{$loan->amount}}" id="approved-amount-{{$loan->id}}" onkeyup="checkApprovedAmount({{$loan->amount}},{{$loan->id}})" style="height: 40px; width: 250px border: 1px solid green; padding: 2px; padding-left: 5px; font-size: 16px">
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
<script>

function checkApprovedAmount($loan_amount,$id)
{
    $approved_amount =  $("#approved-amount-"+$id).val();

    if($approved_amount > $loan_amount)
    {
        $("#note-"+$id).html('Just a Note: Your Approve Amount is Greater than the filed amount.');
    }else{
        $("#note-"+$id).empty();
    }
}

</script>
@endsection