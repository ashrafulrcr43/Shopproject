@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen ">
            
            <div class="card w-90  p-4 brodertyle">
                <div class="card-body border-right-success">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Login</h4>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <svg width="200" height="50" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                                <!-- Orange dot with pulsing effect -->
                                <circle cx="20" cy="25" r="5" fill="#FF6A00">
                                    <animate attributeName="r" values="5;8;5" dur="1s" repeatCount="indefinite" />
                                    <animate attributeName="fill-opacity" values="1;0.5;1" dur="1s"
                                        repeatCount="indefinite" />
                                </circle>
            
                                <!-- .X text with sliding animation -->
                                <text x="35" y="30" font-family="Arial, sans-serif" font-size="24" fill="#002855">
                                    <tspan>.E-</tspan>
                                </text>
            
                                <!-- Shop text with horizontal movement -->
                                <text x="65" y="30" font-family="Arial, sans-serif" font-size="24" fill="#002855">
                                    <tspan>
                                        <animate attributeName="x" values="65; 75; 65" dur="1.5s" repeatCount="indefinite" />
                                        Shop
                                    </tspan>
                                </text>
                            </svg>
                        </div>
                    </div>
                 
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-info">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6 btn btn-outline-success text-dark" href="{{url('/userRegistation')}}">Registration </a>
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