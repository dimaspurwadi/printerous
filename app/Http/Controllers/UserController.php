<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Model\User;
use App\Model\Organization;
use Auth;

class UserController extends BaseController
{
    
    public function index(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();
        
        return view(
            'user.index',
            compact(
                'currentUrl',
                'baseUrl',
                'dataSession'
            )
        );
    }
    
    public function load(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $totalData = $this->getTotalData($req);
        $perPage		= 10;
        $pageNum		= (isset($req->page_num)) ? max(1, $req->page_num) : 1;
        $totalPage = ceil($totalData/$perPage);
        $pageNum = ($pageNum > $totalPage) ? $totalPage : $pageNum;
        if ($pageNum == 0) {
            $pageNum = 1;
        }
        $pageStart = (($pageNum-1) * $perPage);
        $sortBy = isset($req->sort_by) ? $req->sort_by : 'users.created_at';
        $sort = isset($req->sort) ? $req->sort : 'desc';
        $requestData = [
            'per_page' => $perPage,
            'page_start' => $pageStart,
            'sort_by' => $sortBy,
            'sort' => $sort,
            'search' => $req->search
        ];

        $data = $this->getListData($requestData);

        return view(
            'user.index_load',
            compact(
                'baseUrl',
                'data',
                'pageNum',
                'totalPage',
                'pageStart'
            )
        );
    }

    protected function getListData($requestData=[])
    {
        $data = (new User())->getListData([
            'limit' => $requestData['per_page'],
            'offset' => $requestData['page_start'],
            'column_order_by' => $requestData['sort_by'],
            'order_dir' => $requestData['sort'],
            'search' => $requestData['search'],
        ]);
        return $data;
    }

    protected function getTotalData($req)
    {
        $data = (new User())->getTotalData([
            'search' => $req->search,
        ]);
        return $data;
    }

    public function form(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();
        $id = $req->id;
        $data = $this->getByID($id);
        $dataOrganization = (new Organization())->get();
        
        return view(
            'user.form',
            compact(
                'currentUrl',
                'baseUrl',
                'dataSession',
                'dataOrganization',
                'data'
            )
        );
    }

    public function store(UserRequest $req)
    {
        $id = $req->id;
        $cleanData = $this->cleanRequestData($req);
        $dataSession = $req->session()->all();
        if ($id != null) {
            unset($cleanData['created_at']);
            User::where('id', $id)->update($cleanData);
            return redirect()->back()->with('message', 'Data Berhasil Disimpan!');
        } else {
            unset($cleanData['updated_at']);
            $save = User::create($cleanData);
            $lastID = $save->id;
            return redirect()->route('user.form', ['id' => $lastID])->with('message', 'Data Berhasil Disimpan!');
        }
        return redirect()->back()->with('message_success', 'Data Berhasil Disimpan.');
    }

    protected function getByID($id)
    {
        $data = (new User())->getByID($id);
        return $data;
    }

    protected function cleanRequestData($req)
    {
        $date = date('Y-m-d H:i:s');
        $params = $req->all();
        if ($req->new_password <> null) {
            $params['password'] = Hash::make($req->new_password);
        }
        unset($params['id']);
        unset($params['_token']);
        unset($params['new_password']);
        unset($params['new_password_confirmation']);
        $params['created_at'] = $date;
        $params['updated_at'] = $date;
        $params['level'] = 2;
        return $params;
    }

    public function viewDelete(Request $req)
    {
        $id = $req->id;
        $name = $req->name;
        return view('user.delete', compact(
            'id',
            'name'
        ));
    }

    public function delete(Request $req){
        $id = $req->id;
        $data = User::find($id);
        try {
            $data->delete();
            echo "1";
        } catch (\Exception $e) {
            echo "0";
        }
    }
    
}