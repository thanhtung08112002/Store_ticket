<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirplaneBrandRequest;
use App\Models\AirplaneBrandModel;
use Illuminate\Http\Request;

class AirplaneBrandController extends Controller
{
    public function index()
    {
        $list = AirplaneBrandModel::all();
        return view('content.airplanebrand.index', compact('list'));
    }

    public function formAdd()
    {

        return view('content.airplanebrand.formAdd');
    }
    public function add(AirplaneBrandRequest $request)
    {
        $check = AirplaneBrandModel::where('name', $request->name)->first();
        if (!is_null($check)) {
            toastr()->error('Hãng máy bay đã tồn tại');
            return redirect()->back();
        }
        $insert = AirplaneBrandModel::create($request->except('_token'));
        session()->flash('success', 'Thêm thành công');
        return redirect()->route('admin.airplane_brand.index');
    }

    public function formEdit($id)
    {
        $itemEdit = AirplaneBrandModel::find($id);
        return view('content.airplanebrand.formEdit', compact('itemEdit'));
    }
    public function edit(AirplaneBrandRequest $request)
    {
        
        $id = $request->id;
        $update = AirplaneBrandModel::find($id);
        if($request->name != $update->name) {
            $check = AirplaneBrandModel::where('name', $request->name)->first();
            if (!is_null($check)) {
                toastr()->error('Hãng máy bay đã tồn tại');
                return redirect()->back();
            }
        }
        
        $update->fill($request->except('_token'));
        $update->save();
        session()->flash('success', 'Sửa thành công');
        return redirect()->route('admin.airplane_brand.index');
    }

    public function remove($id)
    {
        $remove = AirplaneBrandModel::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('admin.airplane_brand.index');
    }
}
