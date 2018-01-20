<?php

namespace App\Http\Controllers;
use App\Version;
use Illuminate\Http\Request;

class VersionController extends Controller {

	public function showVersion() {
		return response()->json(Version::all());
	}

	public function showOneVersion($id) {
		return response()->json(Version::find($id));
	}

	public function create(Request $request) {
		$data = $request->all();
		$this->validate($request,
			[
				'version' => 'required',
				'newfeature' => 'required',

				// 'link' => 'required',
				// 'permission'=>'required',
				// 'admin_id'=> 'required',
				// 'status'=>'required'
			],
			[

				'version.required' => 'can  nhap version',
				'newfeature.required' => 'can nhap tinh nang',
			]

		);

		$version = Version::create($data);
		return response()->json($version, 201);
	}

	public function update(Request $request, $id) {
		$version = Version::findOrFail($id);
		$data = $request->all();
		$check = 'required';
		if (isset($data['version']) && $data['version'] != $version->version) {
			$check = 'required|unique:version';
		}
		$this->validate($request,
			[

				'version' => $check,
				'newfeature' => 'required',
			],
			[
				'version.required' => 'can  nhap version',
				'newfeature.required' => 'can nhap tinh nang',
			]);
		$version->update($data);
		return response()->json($version, 200);
	}

	public function delete($id) {
		Version::findOrFail($id)->delete();
		return response('Deleted Successfully', 200);
	}
}