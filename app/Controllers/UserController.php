<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController {
    public function index() {
        return view('user_list');
    }

    public function fetchAll() {
        $model = new UserModel();
        $users = $model->findAll();
        return $this->response->setJSON(['users' => $users]);
    }

    public function store() {
        $model = new UserModel();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        $model->save([
            'name' => $name,
            'email' => $email,
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully.']);
    }

    public function edit($id) {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user) {
            return $this->response->setJSON(['success' => true, 'user' => $user]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
        }
    }

    public function update($id) {
        $model = new UserModel();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        $model->update($id, [
            'name' => $name,
            'email' => $email,
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User updated successfully.']);
    }

    public function delete($id) {
        $model = new UserModel();

        if ($model->find($id)) {
            $model->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'User deleted successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found.']);
        }
    }
}
