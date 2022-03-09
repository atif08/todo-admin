<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait CrudTrait
{

    /*
 |--------------------------------------------------------------------------
 | ACCESORS
 |--------------------------------------------------------------------------
 */
    public function getPhotoAttribute($value)
    {
        if (!empty($value)) {
            if (Storage::exists($value)) {
                return asset('storage/' . $value);
            }
           // return asset('assets/admin/media/users/default.jpg');
            return null;
        }
    }

   /* public function getCreatedAtAttribute($value)
    {
        return date('m/d/Y', strtotime($value));
    }*/

/*
|--------------------------------------------------------------------------
| MUTATORS
|--------------------------------------------------------------------------
*/
/*
 |--------------------------------------------------------------------------
 | SCOPES
 |--------------------------------------------------------------------------
 */
    /**
     * @param $query
     * @param $filters
     */
    public function scopeFilter($query, $filters)
    {
        $filters->apply($query);
    }


}