 @if(Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
    </div>
@endif


 @if(Session::has('account_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ Session::get('account_success') }}  <i class="fa fa-check"></i>
             <a href="{{url('accounts/')}}/{{ Session::get('account_id') }}?" style="color:#398BF7;text-decoration: underline;"> Click Here to View Details</a>
    </div>
@endif

 @if(Session::has('loan_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ Session::get('loan_success') }}  <i class="fa fa-check"></i>
             <a href="{{url('loans/')}}/{{ Session::get('loan_id') }}?" style="color:#398BF7;text-decoration: underline;"> Click Here to View Details</a>
    </div>
@endif

 @if(Session::has('borrower_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ Session::get('borrower_success') }}  <i class="fa fa-check"></i>
             <a href="{{url('borrowers/')}}/{{ Session::get('borrower_id') }}?" style="color:#398BF7;text-decoration: underline;"> Click Here to View Details</a>
    </div>
@endif