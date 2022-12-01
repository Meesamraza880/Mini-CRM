<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\EmployeeModel;

use App\Controllers\BaseController;

class Store extends BaseController
{
    public function add_company()
    {

        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'website'      => 'required',
            'status'  => 'required'
        ];
        if ($this->validate($rules)) {
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'website' => $this->request->getVar('website'),
                'status' => $this->request->getVar('status')
            ];
        } else {
            $data['validation'] = $this->validator;
            session()->setFlashdata('add_company_error', $this->validator->listErrors());
            if (session()->getFlashdata('add_company_error')) :
?>
                <div class="alert alert-warning" id="image_msg" style="text-align: center;">
                    <?= session()->getFlashdata('add_company_error') ?>
                </div>
                <?php endif;
        }
        if ($this->request->getVar('name')) {
            $validationRule = [
                'image' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[image,100]'
                        . '|max_dims[image,1024,768]',
                ],
            ];


            if (!$this->validate($validationRule)) {
                session()->setFlashdata('image_error', 'Logo contain only image with minimum size of 100 X 100');
                if (session()->getFlashdata('image_error')) :
                ?>
                    <div class="alert alert-warning" id="image_msg" style="text-align: center;">
                        <?= session()->getFlashdata('image_error') ?>
                    </div>
                <?php endif;
            }
            $image_name = $this->request->getFile('image')->getName();
            $img = $this->request->getFile('image');
            if (!$img->hasMoved()) {
                if ($img->isValid()) {
                    $img->move('./logos');
                }
            }


            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'logo' => $image_name,
                'website' => $this->request->getVar('website'),
                'status' => $this->request->getVar('status'),

            ];
            $record_insert = new CompanyModel();
            $record_insert->save($data);
            if ($this->validate($validationRule)) {
                session()->setFlashdata('image_msg', 'Company is added');
                if (session()->getFlashdata('image_msg')) :
                ?>
                    <div class="alert alert-success" id="image_msg" style="text-align: center;">
                        <?= session()->getFlashdata('image_msg') ?>
                    </div>
                <?php endif;
            }
        }
    }
    public function show_company()
    {
        $record_fetch = new CompanyModel();
        $result = $record_fetch->findAll();
        return json_encode($result);
    }
    public function edit_company()
    {
        $record_fetch = new CompanyModel();
        $id = $this->request->getVar('id');
        $result = $record_fetch->where('company_id', $id)->first();
        return $this->response->setJSON($result);
    }
    public function update_company()
    {
        $record_insert = new CompanyModel();
        $id = $this->request->getVar('company_id');

        $image_name = $this->request->getFile('image');
        if (isset($image_name)) {
            $validationRule = [
                'image' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[image,100]'
                        . '|max_dims[image,1024,768]',
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('image_error', 'Logo contain only image with minimum size of 100 X 100');
                if (session()->getFlashdata('image_error')) :
                ?>
                    <div class="alert alert-warning" id="image_msg" style="text-align: center;">
                        <?= session()->getFlashdata('image_error') ?>
                    </div>
                <?php endif;
            }
            $image_name = $this->request->getFile('image')->getName();
            $img = $this->request->getFile('image');
            if (!$img->hasMoved()) {
                if ($img->isValid()) {
                    $img->move('./logos');
                }
            }
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'logo' => $image_name,
                'website' => $this->request->getVar('website'),
                'status' => $this->request->getVar('status'),

            ];
            $record_insert->update($id, $data);
        } elseif ($this->request->getVar('name')) {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'website' => $this->request->getVar('website'),
                'status' => $this->request->getVar('status'),

            ];
            $record_insert->update($id, $data);
        } elseif (empty($this->request->getVar('name'))) {
            session()->setFlashdata('data_error', 'Please Fill all the fields');
            if (session()->getFlashdata('data_error')) {
                ?>
                <div class="alert alert-danger" id="data_error" style="text-align: center;">
                    <?= session()->getFlashdata('data_error') ?>
                </div>
            <?php
            }
        }
        session()->setFlashdata('image_msg', 'Company is updated');
        if (session()->getFlashdata('image_msg')) :
            ?>
            <div class="alert alert-success" id="image_msg" style="text-align: center;">
                <?= session()->getFlashdata('image_msg') ?>
            </div>
        <?php endif;
    }
    public function delete_company()
    {
        $record_delete = new CompanyModel();
        $id = $this->request->getVar('id');
        $record_delete->delete($id);
        session()->setFlashdata('image_msg', 'Company is deleted');
        if (session()->getFlashdata('image_msg')) :
        ?>
            <div class="alert alert-success" id="image_msg" style="text-align: center;">
                <?= session()->getFlashdata('image_msg') ?>
            </div>
            <?php endif;
    }


    public function add_employee()
    {


        $rules = [
            'fname'          => 'required|min_length[3]|max_length[50]',
            'lname'          => 'required|min_length[3]|max_length[50]',
            'company'     => 'required',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'phone'      => 'required|min_length[11]|max_length[20]',
            'status'  => 'required'
        ];
        if ($this->validate($rules)) {
            $data = [
                'added_by' => $this->request->getVar('added_by'),
                'first_name'     => $this->request->getVar('fname'),
                'last_name'     => $this->request->getVar('lname'),
                'email'    => $this->request->getVar('email'),
                'company_id_fk'    => $this->request->getVar('company'),
                'phone'    => $this->request->getVar('phone'),
                'status' => $this->request->getVar('status')
            ];

            $record = new EmployeeModel();
            $record->save($data);
            session()->setFlashdata('msg', 'Employee is register successfully');
            if (session()->getFlashdata('msg')) :
            ?>
                <div class="alert alert-success" id="msg" style="text-align: center;">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;
        } else {
            $data['validation'] = $this->validator;
            session()->setFlashdata('add_employee_error', $this->validator->listErrors());

            if (session()->getFlashdata('add_employee_error')) :

            ?>
                <div class="alert alert-warning" id="image_msg" style="text-align: center;">
                    <?= session()->getFlashdata('add_employee_error'); ?>
                </div>
            <?php endif;
        }
    }
    public function show_employee()
    {


        $builder = $this->db->table('employees')->select('employees.id,companies.name,employees.first_name,employees.added_by,employees.email,employees.phone,employees.status')->join('companies', 'companies.company_id = employees.company_id_fk', 'inner')->get();
        $query = $builder->getResult();
        return $this->response->setJSON($query);
    }
    public function edit_employee()
    {
        $record_fetch = new EmployeeModel();
        $id = $this->request->getVar('id');
        $result = $record_fetch->where('id', $id)->first();
        return $this->response->setJSON($result);
    }
    public function update_employee()
    {

        $rules = [
            'fname'       => 'required|min_length[3]|max_length[50]',
            'lname'       => 'required|min_length[3]|max_length[50]',
            'company'     => 'required',
            'email'       => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'phone'       => 'required|min_length[11]|max_length[20]',
            'status'      => 'required'
        ];
        if ($this->validate($rules)) {
            $data = [
                'added_by' => $this->request->getVar('added_by'),
                'first_name'     => $this->request->getVar('fname'),
                'last_name'     => $this->request->getVar('lname'),
                'email'    => $this->request->getVar('email'),
                'company_id_fk'    => $this->request->getVar('company'),
                'phone'    => $this->request->getVar('phone'),
                'status' => $this->request->getVar('status')
            ];
            $record_update = new EmployeeModel();
            $id = $this->request->getVar('em_id');
            $record_update->update($id, $data);
            session()->setFlashdata('em_msg', 'employee data is updated successfully');
            if (session()->getFlashdata('em_msg')) :
            ?>
                <div class="alert alert-success" id="em_msg" style="text-align: center;">
                    <?= session()->getFlashdata('em_msg') ?>

                </div>
            <?php endif;
        } else {
            $data['validation'] = $this->validator;
            session()->setFlashdata('update_em_error', $this->validator->listErrors());
            session()->setFlashdata('update_em_other_error', 'Employee data is not updated');
            if (session()->getFlashdata('update_em_error')) :
            ?>
                <div class="alert alert-warning" id="update_em_error" style="text-align: center;">
                    <?= session()->getFlashdata('update_em_error') ?>
                    <?= session()->getFlashdata('update_em_other_error') ?>
                </div>
<?php endif;
        }
    }
    public function delete_employee()
    {
        $record_del = new EmployeeModel();
        $id = $this->request->getVar('id');
        $record_del->delete($id);
    }
}
