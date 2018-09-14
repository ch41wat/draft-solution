<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentAssignment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'equipment_assignments';

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
    protected $fillable = ['technology_id', 'equipment_id', 'picture_id', 'layer'];

}
