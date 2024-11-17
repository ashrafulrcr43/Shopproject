@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen ">
            <div class="card w-90  p-4 brodertyle">
                <div class="card-body border-right-success">
                    <h4>SIGN IN</h4>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-info">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6 btn btn-outline-success text-dark" href="{{url('/userRegistation')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6 btn btn-outline-dark" href="{{url('/sendOtp')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function SubmitLogin(){
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if(email.length===0){
            errorToast('Email is Required')
        }else if(password.length===0){
            errorToast('password is Required')
        }else {
            showLoader()
            let res = await axios.post('/userLogin',{
                email:email,
                password: password
            })
            if(res.status === 200 && res.data['status']=='success'){
                successToast('Login Success')
                window.location.href="/dashboard"
            }else {
                errorToast('Login Failed')
            }
        }


    }
</script>
@endsection