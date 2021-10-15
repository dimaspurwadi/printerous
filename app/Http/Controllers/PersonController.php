<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Model\Person;
use App\Model\Organization;
use App\Http\Requests\PersonRequest;
use DB;
use File;

class PersonController extends BaseController
{

    public function load(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();
        $data = $this->getListData($req);
        return view(
            'person.load',
            compact(
                'baseUrl',
                'data'
            )
        );
    }

    protected function getListData($req)
    {
        $data = (new Person())->get($req->organization_id);
        return $data;
    }

    protected function store(PersonRequest $req)
    {   
        $dataSession = $req->session()->all();
        $files = $req->file('avatar');
        if ($files != null) {
            $fileSize = $files->getSize();
            if ($fileSize > 2000000) {
                return redirect()->back()->with('message_error', 'Maksimal Ukuran File 2 MB.');
            }
        }
        if ($req->action == 'add') {
            return $this->add($req, $dataSession);
        } else {
            return $this->update($req, $dataSession);
        }
    }

    protected function add($req, $dataSession)
    {
        $params['organization_id'] = $req->organization_id;
        $params['name'] = $req->name;
        $params['email'] = $req->email;
        $params['phone'] = $req->phone;
        $files = $req->file('avatar');
        if ($files != null){
            $filename = date('YmdHis')."_".str_replace(' ','-', $files->getClientOriginalName());
            $path = public_path('uploads/file/');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            if ($req->avatar->move(public_path('uploads/file/'), $filename)) {
                $params['avatar'] = $filename;
                $save = Person::create($params);
                return redirect()->route('organization.formEdit', ['id' => $req->organization_id])->with('message_success', 'Data Berhasil Disimpan!');
            } else {
                return redirect()->back()->with('message', 'Data Gagal Disimpan!');
            }
        } else {
            $save = Person::create($params);
            return redirect()->route('organization.formEdit', ['id' => $req->organization_id])->with('message_success', 'Data Berhasil Disimpan!');
        }
    }

    protected function update($req, $dataSession)
    {
        $params['organization_id'] = $req->organization_id;
        $params['name'] = $req->name;
        $params['email'] = $req->email;
        $params['phone'] = $req->phone;
        $files = $req->file('avatar');
        if ($files != null){
            $filename = date('YmdHis')."-".str_replace(' ','-', $files->getClientOriginalName());
            $path = public_path('uploads/file/');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            if ($req->avatar->move(public_path('uploads/file/'), $filename)) {
                $params['avatar'] = $filename;
                $save = Person::where('id', $req->id)->update($params);
                return redirect()->route('organization.formEdit', ['id' => $req->organization_id])->with('message', 'Data Berhasil Disimpan!');
            } else {
                return redirect()->back()->with('message', 'Data Gagal Disimpan!');
            }
        } else {
            $save = Person::where('id', $req->id)->update($params);
            return redirect()->route('organization.formEdit', ['id' => $req->organization_id])->with('message', 'Data Berhasil Disimpan!');
        }
    }
    public function form(Request $req) 
    {
        $data = (new Person())->getByID($req->id);
        return view('person.form_edit', compact(
            'data'
        ));
    }

    public function viewDelete(Request $req)
    {
        $id = $req->id;
        $name = $req->name;
        return view('person.delete', compact(
            'id',
            'name'
        ));
    }

    public function delete(Request $req)
    {
        $id = $req->id;
        $data = Person::find($id);
        
        if ($data->delete()) {
            echo "1";
        } else  {
            echo "0";
        }
    }
}