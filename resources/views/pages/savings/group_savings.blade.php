
@extends('adminlte::page')

@section('title', 'Group Savings')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
    .hasSavings{
        background: #00b585;
        color: white !important;
        border: 1px solid white;
        text-align: center
    }
    .hasNoSavings{
        background: #ddd; 
        border: 1px solid white;
        text-align: center
    }
    </style>
@endsection

@section('content_header')
<h1>Group Total Savings : <strong id="groupTotal">&#8369;{{ number_format($total_savings,2) }}</strong></h1>
<input type="hidden" value='{{$total_savings}}' id="groupTotalText">
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
                @include('errors.with_error')
                @include('errors.success')
            </div>
    <div class="col-md-12">

<div class="zui-wrapper">
        <div class="zui-scroller">
            <table class="zui-table">
                <thead>
                    <tr>
                        <th class="zui-sticky-col">Name</th>
                        @foreach($savings_date as $kk => $vv)
                        <?php $savings_date[$kk] = $vv->id; ?>
                        <th> {{$vv->date->format('M-d-Y')}}</th>
                        @endforeach
                        <th>Total Savings</th>
                   
                    </tr>
                </thead>
                <tbody>

                        @foreach($users as $k => $v)
                        <tr>
                            <td class="zui-sticky-col">{{strtoupper($v->name)}}</td>
                                @foreach($savings_date as $kk => $vv)

                                @if(!empty($v->savedAmount($savings_date[$kk])))
                           
                                <td class="hasSavings">
                                   <span id="savingsContent-{{$v->id}}-{{$savings_date[$kk]}}">&#8369;{{ number_format($v->savedAmount($savings_date[$kk])->amount,2) }}</span>
                                  
                                   @if(Auth::user()->is_admin() )
                                   <a style="color: yellow; cursor: pointer" data-toggle="modal" data-target="#editSavings-{{$v->id}}-{{$savings_date[$kk]}}" title="Add Saving of {{$v->name}}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>

                                      <!-- Edit Savings Modal -->
                                <div id="editSavings-{{$v->id}}-{{$savings_date[$kk]}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                    
                                    <!-- Modal content-->
                                    <div class="modal-content" style="color: black">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="color: black">Edit Savings of {{strtoupper($v->name)}}</h4>
                                        </div>
                                        <div class="modal-body">
                                        {{ Form::open(array('url' => 'edit/savings/' . $v->savedAmount($savings_date[$kk])->id ,'method' => 'POST')) }}
                                        <label for="">AMOUNT </label>
                                        <label>&#8369; <input type="number" autocomplete="off" value="{{$v->savedAmount($savings_date[$kk])->amount}}" style="height: 40px; border: 1px solid green; width: 200px; font-size: 15px; padding: 2px" name="amount" id="amount-{{$v->id}}-{{$savings_date[$kk]}}"></label> 
                                        <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                        
                                        {!! Form::close() !!}
                                        <hr>
                                        <small style="color: red; margin-top: 10px; padding-bottom: 5px">Danger Zone</small>
                                        {{ Form::open(array('url' => 'destroy/savings/' . $v->savedAmount($savings_date[$kk])->id ,'method' => 'POST')) }}
                                            <button onclick="return confirm('Are you sure you want to Delete this saving?')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i> Delete Savings</button>
                                        {!! Form::close() !!}
                                    
                                    </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    @endif

                                        
                                     </div>
                                    </div>
                                </div><!--modal-->
                                </td>
                                @else
                                <td id="savingsContentTd-{{$v->id}}-{{$savings_date[$kk]}}"  class="hasNoSavings">
                                    @if(\Auth::user()->is_admin)
                                    <span id="savingsContent-{{$v->id}}-{{$savings_date[$kk]}}"></span>
                                     <button id="savingsContentButton-{{$v->id}}-{{$savings_date[$kk]}}" class="btn btn-xs"  data-toggle="modal" data-target="#addSavings-{{$v->id}}-{{$savings_date[$kk]}}" title="Add Saving to {{$v->name}}">
                                        <i class="fa fa-plus-circle" aria-hidden="true" style="color: #008ebc"></i>
                                    </button>

                                                                    
                                    <!-- Add Savings Modal -->
                                <div id="addSavings-{{$v->id}}-{{$savings_date[$kk]}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                    
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Savings for {{strtoupper($v->name)}}</h4>
                                        </div>
                                        <div class="modal-body">
           
                                        <label for="">AMOUNT </label>
                                            <label>&#8369; <input type="number" autocomplete="off" style="height: 40px; border: 1px solid green; width: 200px; font-size: 15px; padding: 2px" name="amount" id="amount-{{$v->id}}-{{$savings_date[$kk]}}"></label> 
                                               <input type="hidden" value="{{$savings_date[$kk]}}" name="savings_date_id" id="savings_date_id-{{$v->id}}-{{$savings_date[$kk]}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"  onclick="addSavings({{$v->id}},{{$savings_date[$kk]}})"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
            

                                 
                                       
                                    </div>
                                
                                    </div>
                                </div><!--modal-->
                                    
                                    @else
                                    <span id="savingsContent-{{$v->id}}-{{$savings_date[$kk]}}" title="{{strtoupper($v->name)}} has no SAVINGS for this Date"><i style="color: #FF7800" class="fa fa-times" aria-hidden="true"></i></span>
                                    @endif
                                    
                                </td>
                                @endif
                            @endforeach
                            <td style="background: yellow; font-weight: bold; font-size: 15px; text-align: center">
                                <input type="hidden" id="totalSavingsText-{{$v->id}}" value="{{$v->totalSavings($v->id)}}">
                                &#8369;<span  id="totalSavings-{{$v->id}}">{{number_format($v->totalSavings($v->id),2)}}</span></td>
                          
                        </tr>
                        @endforeach
                        
                   
                </tbody>
            </table>
        </div>
    </div><!--zui-wrapper-->
        
</div><!--div 12-->
</div>
<div class="row" style="margin-top: 20px">
    <hr style="height: 2px;background: #00a861">
    <div class="col-md-12">
    <h4>Last 10 activity logs.<small style="font-size: 12px">(Click <a href="{{url('group/savings')}}"><i class="fa fa-refresh" aria-hidden="true"></i></a> or Refresh Page to update logs) </small></h4>
        <table class="table table-stripped" style="font-size: 12px;">
            <thead>
                <tr>
                    <th>DATE/TIME</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activity_logs as $logs)
                    <tr>
                        <td>{{$logs->created_at->format('M d Y H:i:s A D')}}</td>
                        <td>{{$logs->actions}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{url('logs/savings')}}" title="View Complete Savings Activity Logs.">View all Savings Logs</a>
    </div><!--div 12-->
  </div><!--row-->
@endsection

@section('js')
<script>

function addSavings(num1,num2)
{

   
    var amount =$('#amount-' + num1 + '-' + num2).val();
    var savings_date_id =$('#savings_date_id-' + num1 + '-' + num2).val();
    var totalSavings = $('#totalSavingsText-' + num1).val();
    console.log(totalSavings);
    if(amount =="")
    {
        alert('Amount is Required!');
    }else
    {
        $.ajax({
        type:'POST',
        url:"{{url('store/savings/')}}/"+num1,
        // dataType: 'json',
        data: {amount: amount,
            savings_date_id: savings_date_id,
            _token:"{{csrf_token()}}"
            },
        success:function(result){
            console.log(result);
                if(result==1)
                {
                //Button
                $('#savingsContentButton-' + num1 + '-' + num2).hide();
                //Ammount Content Label
                $('#savingsContent-' + num1 + '-' + num2).html("&#8369;" +amount);
                //Remove and Add Class
                $('#savingsContentTd-' + num1 + '-' + num2).removeClass('hasNoSavings').addClass('hasSavings');
                 //Add TotalSavings
                $('#totalSavings-'+ num1).empty().html(addCommas(parseInt(totalSavings) + parseInt(amount)));
                $('#totalSavingsText-' + num1).val(parseInt(totalSavings) + parseInt(amount));
                //Close Modal
                $('#addSavings-' + num1 + '-' + num2).modal('hide');
                // Add to Group total Savings
                var groupttl = $('#groupTotalText').val();
                $('#groupTotalText').val(parseInt(groupttl) + parseInt(amount));
                
                $('#groupTotal').empty().html("P" + addCommas($('#groupTotalText').val()));

               
                
                console.log('ADDED SUCCESSFULLY!!' );
                }//If result
            
            }
        });
    }//if amount Empty

   
}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


 
</script>
@endsection