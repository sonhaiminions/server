<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller {

	public function showAdmin() {
		return response()->json(Admin::all());
	}

	public function showOneAdmin($id) {
		return response()->json(Admin::find($id));
	}

	public function create(Request $request) {
		// $admin = Admin::create($request->all());
		$data = $request->all();
		// dd($request->file['avatar']);
		$this->validate($request,
			[
				'username' => 'required |
				min:4|max:100|unique:admin',
				'password' => 'required |
				min:4|max:100',
				'avatar' => 'mimes:jpeg,png',

			],
			[
				'username.required' => 'can nhap tai khoan!',
				'username.unique' => 'tai khoan da ton tai',

				'password.min' => 'mật khẩu tối thiểu là 4 ký tự',
				'password.max' => 'toi da 100 ky tu',
			]);
		if (isset($data['avatar'])) {
			$file = $data['avatar'];
			$a = str_random(10) . '.' . $file->getClientOriginalExtension();
			$file->move('img', $a);
			$data['avatar'] = $a;

		} else {
			$data['avatar'] = 'sonhai.jpg';
		}

		$data['password'] = md5($data['password']);

		// dd($data);

		$admin = Admin::create($data);
		// dd($admin);
		return response()->json($admin, 201);
	}

	public function update(Request $request, $id) {
		$admin = Admin::findOrFail($id);
		$data = $request->all();
		// dd();if ($admin->username == $data['username']) {
		$check = 'required |min:4|max:100';
		if (isset($data['username']) && $admin->username != $data['username']) {
			$check = 'required |min:4|max:100|unique:admin';
		}
		$this->validate($request,
			[
				'username' => $check,
				'password' => 'min:4|max:100',
				'avatar' => 'mimes:jpeg,png',

			],
			[
				'username.required' => 'ban chua nhap ten !',

				'username.min' => 'tên thể loại tối thiểu là 4 ký tự',
				'username.unique' => 'ten da ton tai',
				'username.max' => 'toi da 100 ky tu',

				'avatar.mimes' => 'file chua dung dinh dang!',

				'password.min' => 'mật khẩu tối thiểu là 4 ký tự',
				'password.max' => 'toi da 100 ky tu',
			]);

		if (isset($data['avatar'])) {
			$file = $data['avatar'];
			$a = str_random(5) . '.' . $file->getClientOriginalExtension();
			$file->move('img', $a);
			$data['avatar'] = $a;
		} else {
			$data['avatar'] = $admin->avatar;
		}

		// $data['password'] = isset($data['password']) ? md5($data['password']) : '';
		if (isset($data['password'])) {
			$data['password'] = md5($data['password']);
		}
		$admin->update($data);

		return response()->json($admin, 200);
	}

	public function delete($id) {
		Admin::findOrFail($id)->delete();
		return response('Deleted Successfully', 200);
	}
}