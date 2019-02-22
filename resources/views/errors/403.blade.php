@extends('errors.template')

@section('content')
<section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>403</h1>
                <h3 class="text-uppercase">Forbiddon Error!</h3>
                <p class="text-muted m-t-30 m-b-30">YOU DON'T HAVE PERMISSION TO ACCESS ON THIS SERVER.</p>
                <a href="{{url('logout')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back</a> </div>
            <footer class="footer">
    <small style="font-size:12px"><b>© 2018</b> <a href="http://www.skylogistics.com.ph" target="_blank"><img src="{{url('images/skylogisitics.png')}}" style="width:160px;height:auto"></a>| Internal Quality Audit System | Quality Assurance Dept. | Information and Communication Tech. Dept. | <a href="http://www.nikkozabala.com" target="_blank" style="font-size:90%;"> created by: Nikko Zabala</a></small>
</footer>
        </div>
    </section>
@endsection