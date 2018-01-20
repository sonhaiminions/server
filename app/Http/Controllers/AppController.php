<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;

class AppController extends Controller {

	public function showApp() {
		return response()->json(App::all());
	}

	public function showOneApp($id) {
		return response()->json(App::find($id));
	}

	public function create(Request $request) {
		// $admin = Admin::create($request->all());
		$data = $request->all();

		$this->validate($request,
			[
				'name' => 'required |
				min:4|max:100|unique:app',
				'icon' => 'mimes:jpeg,png',
				// 'describ' => 'required '
				// 'hdh' => 'required ',
				// 'publisher' => 'required',
				// 'admin_id' => 'required',
				// 'status' => 'required '
			],
			[
				'name.required' => 'can nhap ten app!',
				'name.unique' => 'ten app da ton tai',

				'name.min' => 'ten app qua ngan ',
				'name.max' => 'teb app qua dai',
				'icon.mimes' => 'file nhap k hop le',
			]);

		if (isset($data['icon'])) {
			$file = $data['icon'];
			$a = str_random(10) . '.' . $file->getClientOriginalExtension();
			$file->move('icon', $a);
			$data['icon'] = $a;

		} else {
			$data['icon'] = 'icon.png';
		}

		$app = App::create($data);

		return response()->json($app, 201);
	}

	public function update(Request $request, $id) {
		$app = App::findOrFail($id);
		$data = $request->all();
		// dd();if ($admin->username == $data['username']) {
		$check = 'required |min:4|max:100';
		if (isset($data['name']) && $app->name != $data['name']) {
			$check = 'required |min:4|max:100|unique:app';
		}
		$this->validate($request,
			[
				'name' => $check,
				'icon' => 'mimes:jpeg,png',
			],
			[
				'name.required' => 'ban chua nhap ten !',

				'name.min' => 'tên app tối thiểu là 4 ký tự',
				'name.unique' => 'ten da ton tai',
				'name.max' => 'toi da 100 ky tu',

				'icon.mimes' => 'file chua dung dinh dang!',
			]);

		if (isset($data['icon'])) {
			$file = $data['icon'];
			$a = str_random(5) . '.' . $file->getClientOriginalExtension();
			$file->move('icon', $a);
			$data['icon'] = $a;
		} else {
			$data['icon'] = $app->icon;
		}

		// $data['password'] = isset($data['password']) ? md5($data['password']) : '';
		$app->update($data);

		return response()->json($app, 200);
	}

	public function delete($id) {
		App::findOrFail($id)->delete();
		return response('Deleted Successfully', 200);
	}
}