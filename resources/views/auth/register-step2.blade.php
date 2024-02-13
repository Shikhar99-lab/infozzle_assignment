@extends('layouts.app') {{-- Assuming you have a default layout --}}
@section('content')

<h2>Step 2: OTP Verification</h2>

<form id="otpForm">
    @csrf

    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" required pattern="\d{6}">

    <button type="button" id="verifyOtpBtn">Verify OTP</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('verifyOtpBtn').addEventListener('click', function () {
            var enteredOtp = document.getElementById('otp').value;

            // Make AJAX request
            $.ajax({
                url: '{{ route("verify-otp") }}',
                method: 'POST',
                data: { otp: enteredOtp },
                success: function (response) {
                    if (response.success) {
                        // Redirect to the next step or perform any other action
                        alert('OTP verified successfully!');
                    } else {
                        alert('Invalid OTP. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error verifying OTP. Please try again.');
                }
            });
        });
    });
</script>

@endsection
