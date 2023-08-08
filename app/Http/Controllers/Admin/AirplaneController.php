<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirplaneRequest;
use App\Models\AirplaneBrandModel;
use App\Models\AirplaneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirplaneController extends Controller
{
    public function index()
    {
        $list = DB::table('airplane')->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')->get(['airplane.id', 'airplane.airplane_name', 'airplane.qty_seat', 'airplane.about', 'airplane.status', 'airplane_brand.name']);
        return view('content.airplane.index', compact('list'));
    }

    public function formAdd()
    {
        $airplane_brand = AirplaneBrandModel::all(['id', 'name']);
        return view('content.airplane.formAdd', compact('airplane_brand'));
    }
    public function add(AirplaneRequest $request)
    {
        $params = [
            'airplane_brand_id' => $request->airplane_brand,
            'airplane_name' => $request->airplane_name,
            "qty_seat" => $request->qty_seat,
            "about" => $request->about,
            "status" => $request->status,
        ];
        $check = AirplaneModel::where('airplane_name', $request->airplane_name)->where('airplane_brand_id', $request->airplane_brand)->first();
        if (!is_null($check)) {
            toastr()->error('Máy bay của hãng hàng không hiện đã tồn tại');
            return redirect()->back();
        }
        $insert = AirplaneModel::create($params);
        session()->flash('success', 'Thêm thành công');
        return redirect()->route('admin.airplane.index');
    }

    public function formEdit($id)
    {
        $airplane_brand = AirplaneBrandModel::all(['id', 'name']);
        $itemEdit = AirplaneModel::find($id);
        return view('content.airplane.formEdit', compact('itemEdit', 'airplane_brand'));
    }
    public function edit(Request $request)
    {
        $params = [
            'airplane_brand_id' => $request->airplane_brand,
            'airplane_name' => $request->airplane_name,
            "qty_seat" => $request->qty_seat,
            "about" => $request->about,
            "status" => $request->status,
        ];
        $id = $request->id;
        $update = AirplaneModel::find($id);
        if($request->airplane_brand != $update->airplane_brand_id) {
            $check = AirplaneModel::where('airplane_name', $request->airplane_name)->where('airplane_brand_id', $request->airplane_brand)->first();
            if (!is_null($check)) {
            toastr()->error('Máy bay của hãng hàng không hiện đã tồn tại');
                return redirect()->back();
            }
        }
        if($request->airplane_name != $update->airplane_name) {
            $check = AirplaneModel::where('airplane_name', $request->airplane_name)->where('airplane_brand_id', $request->airplane_brand)->first();
            if (!is_null($check)) {
            toastr()->error('Máy bay của hãng hàng không hiện đã tồn tại');
                return redirect()->back();
            }
        }
        


        $update->fill($params);
        $update->save();
        session()->flash('success', 'Sửa thành công');
        return redirect()->route('admin.airplane.index');
    }

    public function remove($id)
    {
        $remove = AirplaneModel::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('admin.airplane.index');
    }
}
