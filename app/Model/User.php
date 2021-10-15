<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DB;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'email_verified_at',
        'password',
        'level',
        'api_oken',
        'organization_id',
    ];

    protected static $customMessages = [
        'email.unique_nocase' => 'Email telah terpakai',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUser($id)
    {
        $data = $this->select(
            '*'
        )
        ->where('id', '=', $id)
        ->first();
        return $data;
    }

    public function checkUserByEmail($email, $IDNotIn=null)
    {
        $query = $this->select(
            '*'
        );
        $query->where('username', '=', $username);
        if ($IDNotIn <> null) {
            $query->where('id', '<>', $IDNotIn);
        }
        $data = $query->first();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this::find($id);
        return $data;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getTotalData($requestData=[])
    {
        // DB::enableQueryLog(); // Enable query log
        $query = $this->select(DB::raw('count(1) as total_data'));
        $query->whereRaw('level = ?', 2);
        if (!empty($requestData['search'])) {   // if there is a search parameter, $requestData['search']
            $query->whereRaw('lower(users.name) like ?', ['%'.strtolower($requestData['search']).'%']);
        }
        if (isset($requestData['start_date'])) {
            $date  = explode("/", $requestData['start_date']);
            $date_fix = $date[2]."-".$date[0]."-".$date[1];
            $query->where('users.updated_at', '>=', ''.$date_fix.'');
        }
        if (isset($requestData['end_date'])) {
            $date  = explode("/", $requestData['end_date']);
            $date_fix = $date[2]."-".$date[0]."-".$date[1];
            $query->where('users.created_at', '<=', ''.$date_fix.'');
        }
        $data = $query->first();
        // dd(DB::getQueryLog());
        return $data->total_data;
    }

    public function getListData($requestData=[])
    {
        // DB::enableQueryLog(); // Enable query log
        $query = $this::addSelect([
            'users.id',
            'users.name',
            'users.email',
            'users.created_at',
            'users.updated_at',
            'users.level',
            'users.organization_id',
        ]);
        $query->whereRaw('level = ?', 2);
        if (!empty($requestData['search'])) {   // if there is a search parameter, $requestData['search']
            $query->whereRaw('lower(users.name) like ?', ['%'.strtolower($requestData['search']).'%']);
        }
        if (isset($requestData['start_date'])) {
            $date  = explode("/", $requestData['start_date']);
            $date_fix = $date[2]."-".$date[0]."-".$datecategories[1];
            $query->where('users.updated_at', '>=', ''.$date_fix.'');
        }
        if (isset($requestData['end_date'])) {
            $date  = explode("/", $requestData['end_date']);
            $date_fix = $date[2]."-".$date[0]."-".$date[1];
            $query->where('users.updated_at', '<=', ''.$date_fix.'');
        }
        $query->orderBy($requestData['column_order_by'], $requestData['order_dir'])
        ->limit($requestData['limit'])
        ->offset($requestData['offset'])
        ->get();
        // dd(DB::getQueryLog());
        $data = $query->get();
        return $data;
    }
    
}
