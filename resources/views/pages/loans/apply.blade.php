
@extends('adminlte::page')

@section('title', 'Loan Application')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection

@section('content_header')
    <h1>Apply for Loan</h1>
@endsection

@section('content')
    <p style="color: #40a67b; font-weight: bold">All loans are subject for Admin Approval.</p>
<h3>Available Loanable Amount : &#8369;{{ number_format($loanbleAmount,2) }}</h3>
<hr>
<div class="row">
        <div class="col-md-12">
                @include('errors.with_error')
                @include('errors.success')
            </div>

    <div class="col-md-5">
            {!! Form::open(array('name'=>'apply_for_loan','id'=>'apply_for_loan','action'=>'LoansController@store')) !!}
            
            <div class="form-group">
                <label for="">DATE YOU NEED YOUR LOAN</label>
                <input type="date" name="needed_date" class="form-control" value="{{old('needed_date')}}"> 
            </div>
            <div class="form-group">
            <label for="">AMOUNT </label>
            <input type="number" name="amount" class="form-control" autocomplete="off" value="{{old('amount')}}"> 
            </div>

            <div class="form-group">
                <label for="">NOTES </label>
            <textarea name="remarks" class="form-control" rows="8">{{old('remarks')}}</textarea>
            </div>

            <div class="form-group">
            <button onclick="return confirm('Are you sure you want to Submit this Loan Application?')" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
            {!! Form::close() !!}
       
    </div>
</div>
@endsection

@section('js')

@endsection