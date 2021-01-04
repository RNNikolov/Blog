@extends('layouts.second')

@section('content')
<div class="container mt-5" style="font-family: Montserrat">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <h5>Before proceeding, please check your email for a verification link.</h5>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <p class="mt-2">If you did not receive the email,</p>
                        <button type="submit" class="btn btn-block btn-success">Click here to request another</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
