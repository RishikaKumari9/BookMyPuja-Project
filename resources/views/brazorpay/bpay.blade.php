<!DOCTYPE html>
<html>
<head>
    <title>Laravel 12 Razorpay</title>
</head>
<body>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<button id="rzp-button2">Pay ₹500</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "50000",
    "currency": "INR",
    "name": "Laravel 12 Demo",
    "description": "Test Payment",
    "handler": function (response){
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('bpayment') }}";

        var csrf = document.createElement('input');
        csrf.name = "_token";
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        var input = document.createElement('input');
        input.name = "razorpay_payment_id";
        input.value = response.razorpay_payment_id;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
};
var rzp2 = new Razorpay(options);
document.getElementById('rzp-button2').onclick = function(e){
    rzp2.open();
    e.preventDefault();
}
</script>

</body>
</html>
