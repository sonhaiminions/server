<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function showUser() {
		return response()->json(User::all());
	}

	public function showOneUser($id) {
		return response()->json(User::find($id));
	}

	public function create(Request $request) {
		// $admin = Admin::create($request->all());
		$data = $request->all();
		// dd($request->all());
		$this->validate($request,
			[
				'username' => 'required |
				min:4|max:100|unique:user',
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

		$user = User::create($data);
		// dd($user);
		return response()->json($user, 201);
	}

	public function update(Request $request, $id) {
		$user = User::findOrFail($id);
		$data = $request->all();
		// dd();if ($admin->username == $data['username']) {
		$check = 'required |min:4|max:100';
		if (isset($data['username']) && $user->username != $data['username']) {
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
			$data['avatar'] = $user->avatar;
		}

		if (isset($data['password'])) {
			$data['password'] = md5($data['password']);
		}
		// dd($user);
		$user->update($data);

		return response()->json($user, 200);
	}

	public function delete($id) {
		User::findOrFail($id)->delete();
		return response('Deleted Successfully', 200);
	}
}