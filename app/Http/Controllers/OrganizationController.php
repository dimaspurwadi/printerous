<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Model\Organization;
use App\Model\Person;
use App\Lib\Service\StoreProduct;
use App\Http\Requests\OrganizationRequest;
use Auth;
use Cache;
use Validator;
use File;
use DB;

class OrganizationController extends BaseController
{
    public function index(Request $req)
    {
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();

        return view(
            'organization.index',
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
        $dataSession = $req->session()->all();
        $totalData = $this->getTotalData($req);
        $perPage		= 10;
        $pageNum		= (isset($req->page_num)) ? max(1, $req->page_num) : 1;
        $totalPage = ceil($totalData/$perPage);
        $pageNum = ($pageNum > $totalPage) ? $totalPage : $pageNum;
        if ($pageNum == 0) {
            $pageNum = 1;
        }
        $pageStart = (($pageNum-1) * $perPage);
        $data = $this->getListData($req, $perPage, $pageStart);

        return view(
            'organization.load',
            compact(
                'baseUrl',
                'data',
                'pageNum',
                'totalPage',
                'pageStart',
                'dataSession'
            )
        );
    }

    protected function getListData($req, $perPage, $pageStart)
    {
        $sortBy = isset($req->sort_by) ? $req->sort_by : 'created_at';
        $sort = isset($req->sort) ? $req->sort : 'desc';
        $data = (new Organization())->getListData([
            'limit' => $perPage,
            'offset' => $pageStart,
            'column_order_by' => $sortBy,
            'order_dir' => $sort,
            'search' => $req->search,
            'based_on' => $req->based_on,
        ]);
        return $data;
    }

    protected function getTotalData($req)
    {
        $data = (new Organization())->getTotalData([
            'search' => $req->search,
            'based_on' => $req->based_on,
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

        return view(
            'organization.form',
            compact(
                'currentUrl',
                'baseUrl',
                'dataSession',
                'data'
            )
        );
    }

    public function formEdit(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();
        $id = $req->id;
        $data = $this->getByID($id);
        return view(
            'organization.form_edit',
            compact(
                'currentUrl',
                'baseUrl',
                'dataSession',
                'data'
            )
        );
    }

    public function store(OrganizationRequest $req)
    { 
        $id = $req->id;
        $dataSession = $req->session()->all();
        if ($id != null) {
            return $this->update($id, $req, $dataSession);
        } else {
            return $this->add($req, $dataSession);
        }
        return redirect()->back()->with('message_success', 'Data Berhasil Disimpan.');
    }

    protected function add($req, $dataSession)
    {
        $files = $req->file('logo');
        $cleanData = $this->cleanRequestData($req, 'add');
        $filename = date('YmdHis')."_".str_replace(' ','-', $files->getClientOriginalName());
        $path = public_path('uploads/file/');
        if (!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $cleanData['logo'] = $filename;
        
        if ($req->logo->move(public_path('uploads/file/'), $filename)) {
            $save = Organization::create($cleanData);
            $lastID = $save->id;
            return redirect()->route('organization.formEdit', ['id' => $lastID])->with('message', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->back()->with('message', 'Data Gagal Disimpan!');
        }
    }

    protected function update($id, $req, $dataSession)
    {
        $files = $req->file('logo');
        $cleanData = $this->cleanRequestData($req, 'edit');
        
        if ($files != null) {
            $filename = date('YmdHis').str_replace(' ','-', $files->getClientOriginalName());
            $path = public_path('uploads/file/');
            $cleanData['logo'] = $filename;
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            if ($req->logo->move(public_path('uploads/file/'), $filename)) {
                Organization::where('id', $id)->update($cleanData);
                return redirect()->route('organization.formEdit', ['id' => $id])->with('message', 'Data Berhasil Disimpan!');
            } else {
                return redirect()->route('organization.formEdit', ['id' => $id])->with('message', 'Data Gagal Disimpan!');
            }
        } else {    
            Organization::where('id', $id)->update($cleanData);
            return redirect()->route('organization.formEdit', ['id' => $id])->with('message', 'Data Berhasil Disimpan!');
        }
    }
    protected function getByID($id)
    {
        $data = (new Organization())->getByID($id);
        return $data;
    }

    protected function cleanRequestData($req, $action = 'add')
    {
        $date = date('Y-m-d H:i:s');
        $params = $req->all();
        unset($params['id']);
        unset($params['_token']);
        
        $params['created_at'] = $date;
        $params['updated_at'] = $date;
        $dataSession = $req->session()->all();
        if ($action == 'edit') {
            unset($params['created_at']);
        } else {
            unset($params['updated_at']);            
        }
        return $params;
    }

    public function viewDelete(Request $req)
    {
        $id = $req->id;
        $name = $req->name;
        return view('organization.delete', compact(
            'id',
            'name'
        ));
    }

    public function delete(Request $req)
    {
        $id = $req->id;
        $data = Organization::find($id);
        if ($data->delete()) {
            Person::where('organization_id', $id)->delete();
            echo "1";
        } else  {
            echo "0";
        }
    }

    public function detail(Request $req, $id)
    {
        $key = 'product_'.$id;
        $ttl = 30 * 180;
		$response = Cache::remember($key, $ttl, function() use($id) {
            $data = (new Product())->getByID($id);
            $category = $data->category;
            $productGambar = $data->productGambar;
            $productWarna = $data->productWarna;
            $productUkuran = $data->productUkuran;
            return response()->json([
                "status" => true,
                "message" => "Sukses Get Data",
                "data" => [
                    "product" => $data,
                ],
            ], 200);
        });

        return $response;
    }
}