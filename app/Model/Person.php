<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Person extends Model
{
    protected $table = 'person';
    protected $fillable = [
        'organization_id',
        'name',
        'email',
        'phone',
        'avatar',
    ];

    public function get($organizationID)
    {
        $data = $this->select(
            '*'
        )
        ->where('organization_id', $organizationID)
        ->get();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this::find($id);
        return $data;
    }
    
}