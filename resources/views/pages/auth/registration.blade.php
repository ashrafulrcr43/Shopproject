@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3 brodertyle">
                <div class="card-body">
                    <h4>Sign Up</h4>
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
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-info">Complete</button>
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