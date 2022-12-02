<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Controllers\BaseController;

class StoreSubAdmin extends BaseController
{

    public function sub_admin_add_employee()
    {
        $email = $this->request->getVar('email');
        $record = new EmployeeModel();
        $exitss = $record->where("email", $email)->first();
        if (isset($exitss)) {
            session()->setFlashdata('em_email_error', 'This email already exits please choose another one');
            if (session()->getFlashdata('em_email_error')) :
?>
                <div class="alert alert-danger" style="text-align: center;">
                    <?= session()->getFlashdata('em_email_error') ?>
                </div>
                <?php endif;
        } else {

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
                session()->setFlashdata('sub_msg', 'Employee is register successfully');
                if (session()->getFlashdata('sub_msg')) :
                ?>
                    <div class="alert alert-success" style="text-align: center;">
                        <?= session()->getFlashdata('sub_msg') ?>
                    </div>
                <?php endif;
            } else {
                $data['validation'] = $this->validator;
                session()->setFlashdata('add_sub_em_error', $this->validator->listErrors());

                if (session()->getFlashdata('add_sub_em_error')) :

                ?>
                    <div class="alert alert-warning" style="text-align: center;">
                        <?= session()->getFlashdata('add_sub_em_error'); ?>
                    </div>
                <?php endif;
            }
        }
    }
    public function sub_admin_show_employee()
    {

        $builder = $this->db->table('employees')->select('employees.id,companies.name,employees.first_name,employees.added_by,employees.email,employees.phone,employees.status')->join('companies', 'companies.company_id = employees.company_id_fk', 'inner')->where('added_by !=', 'admin')->get();
        $query = $builder->getResult();
        return $this->response->setJSON($query);
    }
    public function sub_admin_edit_employee()
    {
        $record_fetch = new EmployeeModel();
        $id = $this->request->getVar('id');
        $result = $record_fetch->where('id', $id)->first();
        return $this->response->setJSON($result);
    }
    public function sub_admin_update_employee()
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
            $id = $this->request->getVar('sub_ad_em_id');
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
            session()->setFlashdata('update_sub_em_error', $this->validator->listErrors());
            if (session()->getFlashdata('update_sub_em_error')) :
            ?>
                <div class="alert alert-warning" style="text-align: center;">
                    <?= session()->getFlashdata('update_sub_em_error') ?>
                </div>
<?php endif;
        }
    }
    public function sub_admin_delete_employee()
    {
        $record_del = new EmployeeModel();
        $id = $this->request->getVar('id');
        $record_del->delete($id);
    }
}
