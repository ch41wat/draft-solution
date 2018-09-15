<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'technologies';

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
    protected $fillable = ['name', 'picture', 'video', 'service'];

    public function equipment_assignments()
    {
        return $this->hasMany('App\EquipmentAssignment');
    }

}
