@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <button onclick="VerifyEmail()"  class="btn w-100 float-end bg-gradient-info">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function VerifyEmail(){
        let email = document.getElementById('email').value
        if(email.length===0){
            errorToast('Email is Required');
        }else {
            sessionStorage.setItem("email", email);
            showLoader()
            let res = await axios.post('sendOtp',{
                email:email
            });
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast("Send 4 Digit Code Successfully ")
                setTimeout(function(){
                    window.location.href="/varifyOtp"
                },1000)
            }else {
                errorToast("Email Not Varify");
            }
        }
    }
</script>
@endsection