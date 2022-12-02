<div class="container">
    <?php
    if (session()->getFlashdata('forget_msg')) : ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?= session()->getFlashdata('forget_msg') ?>
        </div>
    <?php endif; ?>

    <?php
    if (session()->getFlashdata('new_pass_msg')) : ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?= session()->getFlashdata('new_pass_msg') ?>
        </div>
    <?php endif; ?>
    <center>
        <h1 style="color: red;"> <?php echo (isset($msg)) ? $msg : "" ?></h1>
    </center>
    <div class="card  border border-primary shadow-lg my-2 mx-auto mt-5" style="width: 70%;">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12 mx-auto">
                    <div class="p-5">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>