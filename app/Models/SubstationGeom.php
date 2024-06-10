<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubstationGeom extends Model
{
    use HasFactory;
    public $table = 'tbl_substation_geom';
    protected $fillable = ['id', 'geom'];

    public function substations() {
        return $this->hasMany(Substation::class, 'geom_id');
    }
}
