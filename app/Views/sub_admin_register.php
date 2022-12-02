                         <div class="container">
                             <div id="register_employee_sub_admin_msg"></div>
                             <div class="card  border border-primary shadow-lg my-2 mx-auto" style="width: 70%;">
                                 <div class="card-body p-0">
                                     <!-- Nested Row within Card Body -->
                                     <div class="row">

                                         <div class="col-lg-12 mx-auto">
                                             <div class="p-5">
                                                 <div class="text-center">
                                                     <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                                 </div>
                                                 <form class="row g-3 d-flex justify-content-center needs-validation  p-3 mb-3 mt-3" id="sub_admin_add_employee">

                                                     <div class="col-sm-6">

                                                         <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="fname" required>

                                                     </div>
                                                     <div class="col-sm-6">

                                                         <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="lname" required>

                                                     </div>
                                                     <div class="col-sm-12 col-lg-12">

                                                         <div class="input-group has-validation">
                                                             <span class="input-group-text Cfont" id="inputGroupPrepend">@</span>
                                                             <input type="text" class="form-control" id="validationCustomUsername" placeholder="Email" name="email" aria-describedby="inputGroupPrepend" required>
                                                             <input type="hidden" class="form-control" id="added_by" value="<?php $name = session()->get('user_login');
                                                                                                                            echo $name['role'] ?>" name="added_by">
                                                         </div>
                                                     </div>
                                                     <div class="col-sm-12 col-lg-12">

                                                         <select class="form-select" aria-label="Default select example" name="company">
                                                             <option selected value="">Select Company</option>
                                                             <?php
                                                                foreach ($data as $key => $value) {
                                                                ?>
                                                                 <option value="<?php echo $value['company_id'] ?>"><?php echo $value['name'] ?></option>
                                                             <?php

                                                                }
                                                                ?>
                                                         </select>

                                                     </div>


                                                     <div class="col-sm-6">
                                                         <input type="text" class="form-control" id="validationCustom01" placeholder="#phone" name="phone" required>

                                                     </div>


                                                     <div class="col-sm-6 ">
                                                         <!-- <small class="Cfont">Gender</small><br> -->

                                                         <select class="form-select" aria-label="Default select example" name="status">
                                                             <option value="" selected>Select Status</option>
                                                             <option value="Active">Active</option>
                                                             <option value="InActive">InActive</option>
                                                         </select>
                                                     </div>
                                                     <div class="col-12 col-sm-12">

                                                         <button class="btn btn-primary float-end mx-3 shadow" type="submit" name="register">Add Employee</button>

                                                     </div>

                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                         </div>