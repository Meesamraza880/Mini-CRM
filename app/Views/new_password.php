<form class="row g-3 d-flex justify-content-center Cform needs-validation p-3 mt-5" method="POST" action="#" novalidate>
    <div class="col-10 col-sm-8 col-md-8 text-center Cfont">
        <h3>Reset Password</h3>
    </div>
    <div class="col-10 col-sm-8 col-md-8">
        <div class="input-group has-validation">
            <span class="input-group-text Ca" id="inputGroupPrepend"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                </svg></span>
            <input type="hidden" name="email" value="<?php //echo $_REQUEST['email'] 
                                                        ?>">
            <input type="password" class="form-control" id="validationCustomUsername" placeholder="New Password" name="password" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please Enter Password.
            </div>
        </div>

    </div>
    <div class="col-10 col-sm-8 col-md-8">
        <div class="input-group has-validation">
            <span class="input-group-text Ca" id="inputGroupPrepend"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                </svg></span>
            <input type="password" class="form-control" id="validationCustomUsername" placeholder="Confirm Password" name="Cpassword" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please Confirm Password.
            </div>
        </div>

    </div>

    <div class="d-grid gap-2 col-10 mx-auto col-md-8 mb-4">

        <button class="btn btn-success" type="submit" name="forget">Reset Password</button>
    </div>

</form>