@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3 brodertyle">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Registration</h4>
                        </div>
                        <div class="col-md-9 d-flex justify-content-end">
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
                   
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Phone Number</label>
                                <input id="phone" placeholder="phone" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-6 p-2">
                                <div class="row d-flex justify-content-around">
                                    <div class="col-md-4">
                                        <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-info">Complete</button>
                                    </div>
                                    <div class="col-md-4 text-center mt-3">
                                        <h3>OR</h3>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <a class="text-center btn w-100 bg-gradient-success" href="{{url('/userLogin')}}">Login </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   async function onRegistration(){
        let email = document.getElementById("email").value;
        let firstName = document.getElementById("firstName").value;
        let lastName = document.getElementById("lastName").value;
        let phone = document.getElementById("phone").value;
        let password = document.getElementById("password").value;


        if(email.length===0){
            errorToast('Email is Required');
        }else if(firstName.length===0){
            errorToast('firstName is Required');
        }else if(lastName.length===0){
            errorToast('lastName is Required');
        }else if(phone.length===0){
            errorToast('mobile is Required');
        }else if(password.length===0){
            errorToast('Password is Required');
        }else {
            showLoader()
            let res = await axios.post('/userRegistration',{
                email:email,
                firstName:firstName,
                lastName:lastName,
                phone:phone,
                password:password

            })
            hideLoader();
            if(res.status===200 && res.data['status']=='success'){
                successToast(res.data['message'])
                setTimeout(function(){
                     window.location.href="/userLogin"
                },200)
               
            }else {
                errorToast('Registration Failed');
            }
            
        }

    }
</script>
@endsection