<form class="row g-3 d-flex justify-content-center Cform needs-validation p-3 mt-5" method="POST" action="forget_process" novalidate>
    <div class="col-10 col-sm-8 col-md-8 text-center Cfont">
        <h3>Forget Password?</h3>
    </div>
    <div class="col-10 col-sm-8 col-md-8 ">


        <div class="input-group has-validation">
            <span class="input-group-text Ca" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control" id="validationCustomUsername" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please Enter Email.
            </div>
        </div>

    </div>
    <div class="col-10 col-sm-8 col-md-8">
        <button class="btn btn-success col-4 float-end" type="submit" name="forget">Search</button>
        <a href="index.php?login" class="btn btn-secondary col-4 float-end mx-2" name="forget">Cancel</a>
    </div>

    <div class="d-grid gap-2 col-10 mx-auto col-md-12 mb-4">


    </div>

</form>