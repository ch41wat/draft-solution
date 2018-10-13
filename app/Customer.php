<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name_th', 'company_name_en', 'customer_name_th', 
        'customer_name_en', 'latitude', 'longitude', 'approve_status'
    ];

    public function draft()
    {
        return $this->hasMany('App\Draft');
    }
}
