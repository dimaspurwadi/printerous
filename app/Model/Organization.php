<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Person;

class Organization extends Model
{
    protected $table = 'organization';
    protected $fillable = [
        'name', 
        'phone',
        'email',
        'website',
        'logo',
    ];

    public function get()
    {
        $data = $this->select(
            '*'
        )
        ->get();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this::find($id);
        return $data;
    }

    public function person()
    {
        return $this->hasMany(Person::class,'organization_id', 'id');
    }

    public function getTotalData($requestData=[])
    {
        //dd($requestData);
        DB::enableQueryLog(); // Enable query log
        $query = $this->select(DB::raw('count(1) as total_data'));
        if ($requestData['based_on'] == 'pic' && $requestData['search'] != null ) {
            $query->leftJoin('person', 'person.organization_id', '=', 'organization.id');
        }
        $query->whereRaw('1=?', 1);
        if ($requestData['search'] != null) {   // if there is a search parameter, $requestData['search']
            if ($requestData['based_on'] == 'pic') {
                $query->where('person.name', 'like', '%'.$requestData['search'].'%');
            } else {
                $query->where('organization.name', 'like', '%'.$requestData['search'].'%');
            }
        }
        $data = $query->first();
        // dd(DB::getQueryLog());
        return $data->total_data;
    }

    public function getListData($requestData=[])
    {
        $query = $this::addSelect([
            'organization.id',
            'organization.name', 
            'organization.phone',
            'organization.email',
            'organization.website',
            'organization.logo',
            'organization.created_at',
            'organization.updated_at',
        ]);
        if ($requestData['based_on'] == 'pic' && $requestData['search'] != null ) {
            $query->leftJoin('person', 'person.organization_id', '=', 'organization.id');
        }
        $query->whereRaw('1=?', 1);
        if ($requestData['search'] != null) {   // if there is a search parameter, $requestData['search']
            if ($requestData['based_on'] == 'pic') {
                $query->where('person.name', 'like', '%'.$requestData['search'].'%');
            } else {
                $query->where('organization.name', 'like', '%'.$requestData['search'].'%');
            }
        }

        $query->orderBy('organization.created_at', 'desc');

        if ($requestData['search'] == '') {
            $query->limit($requestData['limit']);
            $query->offset($requestData['offset']);
        }
        $query->get();
        $data = $query->get();
        return $data;
    }
}