@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<style>

#error_message{
    display: none;
}

#results{
    display: none;
}
    
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">mortgage-calculator</div>

                <div class="card-body">
                    <form method="" action="">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                        <div id="error_message" class="p-3 bg-danger-subtle mt-3 bg-primary-subtle border border-primary-subtle rounded-3">
                        
                        </div>

                        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                              <div id="error_message" class="toast-body">
                              </div>
                              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                          </div>
                                  
<div class="input-group mb-3">
<span class="input-group-text">purchase prices</span>
<input type="text" class="form-control" name="p_price" id="p_price">
</div>

<div class="input-group mb-3">
<span class="input-group-text">down payment</span>
<input type="text" class="form-control" name="d_price" id="d_price" >
</div>

<div class="input-group mb-3">
<span class="input-group-text">repayment time (Years)</span>
<input type="text" class="form-control" name="r_time" id="r_time">
</div>

<div class="input-group mb-3">
    <span class="input-group-text">interest rate</span>
    <input type="text" class="form-control" name="i_rate" id="i_rate">
    </div>

    <div class="mb-3"> <input type="button" id="calculate" class="btn btn-primary align-center align-middle" value="Calculate Now" /> </div>
                    </form>
                </div>


<hr>

<div id="results" class="card">
    <div class="card-body">
<div class="p-3 text-white bg-success border border-primary-subtle rounded-3">
Your loan amount is <span id="L_amount">Rs.30000/-</span>
</div>

<div class="p-3 text-primary-emphasis mt-3 bg-primary-subtle border border-primary-subtle rounded-3">
    Estimated amount you'll pay on a monthly basis <span id="EMI">Rs.30000/-</span>
</div>
    </div>
  </div>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    
$('#calculate').on('click', function(){

// alert('btn clickeds');
var p_price = $("#p_price").val();
var d_price = $("#d_price").val();
var r_time = $("#r_time").val();
var i_rate = $("#i_rate").val();
var _token = $("input[name='_token']").val();
var data={'p_price': p_price, 'd_price':d_price, 'r_time':r_time, 'i_rate':i_rate, '_token':_token,};

$.ajax({

url:"{{ route('calculate')  }}",
data : data,
dataType: "json",
type: "POST",
success: function(data){
    console.log(data);

    if (data.status=='success') {

        $("#results").show();
$("#L_amount").text(data.loan_amount);
$("#EMI").text(data.EMI);

    }
    else{
        $("#error_message").show();
        $("#results").hide();
$("#error_message").text("something went wrong, All fiends are required. and only numbers are allowed");
    }



        }
});

});


</script>



@endsection
