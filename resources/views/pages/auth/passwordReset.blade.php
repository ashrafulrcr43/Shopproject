@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br/>
                    <label>New Password</label>
                    <input id="password" placeholder="New Password" class="form-control" type="password"/>
                    <br/>
                    <label>Confirm Password</label>
                    <input id="cpassword" placeholder="Confirm Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="ResetPass()" class="btn w-100 bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function ResetPass(){
        let password = document.getElementById('password').value
        let cpassword = document.getElementById('cpassword').value

        if(password.length===0){
            errorToast('New password Required');
        }else if(cpassword.length===0){
            errorToast('Confirm Password Required');
        }else if(password !==cpassword){
            errorToast('Password Not Macth');
        }else {
            showLoader()
            let res = await axios.post('/password-reset',{
                password:password
            });
            hideLoader();
            if(res.data['status']=='success'){
                successToast("Password Change Successfully")
                setTimeout(function(){
                    window.location.href="/userLogin"
                },1000)
            }else{
                errorToast(res.data['message']);
            }
        }

    }
</script>
@endsection