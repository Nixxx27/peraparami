@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-ios-briefcase"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">MY SAVINGS</span>
            <span class="info-box-number">&#8369; 40,000</span>
            <span>last saving: 01/12/2018</span>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-paper"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">MY LOAN BALANCE</span>
            <span class="info-box-number">&#8369; 40,000</span>
        </div>
    </div>
</div>
</div>

<hr> 
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">GROUP TOTAL SAVINGS</span>
                <span class="info-box-number">&#8369; 40,000</span>
                <span>last update: 01/12/2018</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="ion ion-ios-paper"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">AVAILABLES CASH ON HAND</span>
                <span class="info-box-number">&#8369; 40,000</span>
            </div>
        </div>
    </div>
    </div>
@endsection