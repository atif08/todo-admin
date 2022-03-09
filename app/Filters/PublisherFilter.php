<?php
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 8/4/2021
 * Time: 5:26 PM
 */

namespace App\Filters;
use Carbon\Carbon;

class PublisherFilter extends Filters
{
    protected $name;
    protected $filters=['generalSearch','status','dateRange'];
    /**
     * @param $type
     * @return mixed
     */

    public function status($status){
            return $this->builder->where('status',$status);
    }
    public function generalSearch($generalSearch){
        if($generalSearch !='undefined' && !empty($generalSearch)){
            return $this->builder->where('company_name', 'like', '%'.$generalSearch.'%');
        }
    }
    public function dateRange($dateRange){
        if($dateRange !='undefined' && !empty($dateRange)){
            $date = explode('-',$dateRange);
            $start=Carbon::parse($date[0])->format('Y-m-d');
            $end=Carbon::parse($date[1])->format('Y-m-d');
            //   dd($start,$end);
            return $this->builder->whereBetween('created_at', [$start, $end]);
        }
    }

}
