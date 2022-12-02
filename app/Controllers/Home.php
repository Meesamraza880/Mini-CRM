<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\UserModel;

use Config\Services;

class Home extends BaseController
{

    public function index()
    {

        return view('header.php') . view('welcome_message.php') . view('footer.php');
    }
    public function login()
    {
        $check_login = session()->get('user_login');
        if (isset($check_login['isLoggedIn']) && $check_login['role'] == 'admin') {
            return $this->response->redirect('/admin_dashboard');
        } elseif (isset($check_login['isLoggedIn']) && $check_login['role'] == 'sub-admin') {
            return $this->response->redirect('/sub_admin_dashboard');
        } else {
            return view('header') . view('login') . view('footer');
        }
    }
    public function login_process()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $userModel->where('email', $email)->first();

        if (!empty($data)) {
            $hash = $data['password'];

            $authenticatePassword = password_verify($password, $hash);
            if ($authenticatePassword) {
                $ses_data['user_login'] = [
                    'id' => $data['user_id'],
                    'name' => $data['full_name'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                if ($data['role'] == "admin") {
                    return $this->response->redirect('/admin_dashboard');
                } elseif ($data['role'] == "sub-admin") {
                    return $this->response->redirect('/sub_admin_dashboard');
                }
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return $this->response->redirect('/');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist.');
            return $this->response->redirect('/');
        }
    }
    public function forget_pass()
    {
        return view('header') . view('forget') . view('footer');
    }
    public function forget_process()
    {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $data = $userModel->where('email', $email)->first();
        if ($data) {
            session()->setFlashdata('user_id', $data['user_id']);
            return $this->response->redirect('/new_pass');
        } else {
            session()->setFlashdata('forget_msg', 'Please insert valid email.');
            return $this->response->redirect('/forget_pass');
        }
    }
    public function new_pass()
    {
        return view('header') . view('new_password') . view('footer');
    }
    public function new_pass_process()
    {
        $userModel = new UserModel();
        $pass = $this->request->getVar('password');
        $cpass = $this->request->getVar('Cpassword');
        $id = $this->request->getVar();
        if ($pass == $cpass) {
            $final_pass = password_hash($cpass, PASSWORD_DEFAULT);
            $data = [
                'password'  => "$final_pass",
            ];
            $userModel->update($id, $data);
            session()->setFlashdata('success_msg', 'Your password updated successfully');
            return $this->response->redirect('/');
        } else {
            session()->setFlashdata('new_pass_msg', 'Password not match with confirm password Please insert again email.');
            return $this->response->redirect('/forget_pass');
        }
    }
    public function admin_dashboard()
    {
        $record_fetch = new CompanyModel();
        $result['data'] = $record_fetch->where('status', 'Active')->findAll();
        $login = session()->get('user_login');

        if (isset($login['isLoggedIn'])) {
            return view('header') . view('dashboard', $result) . view('footer');
        } else {
            session()->setFlashdata('msg', 'please login first');
            return $this->response->redirect('/');
        }
    }

    public function sub_admin_dashboard()
    {
        $record_fetch = new CompanyModel();
        $result['data'] = $record_fetch->where('status', 'Active')->findAll();
        $login = session()->get('user_login');
        if (isset($login['isLoggedIn'])) {
            return view('header') . view('sub_admin_dashboard', $result) . view('footer');
        } else {
            session()->setFlashdata('msg', 'please login first');
            return $this->response->redirect('/');
        }
    }

    public function logout()
    {
        session()->remove('user_login');
        return $this->response->redirect('/');
    }
}
