<?php
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 8/4/2021
 * Time: 5:26 PM
 */

namespace App\Filters;
use Carbon\Carbon;

class SubscriberFilter extends Filters
{
    protected $name;
    protected $filters=['status','parent','dateRange','month','publication_id','userName','subscriber_id','dateRange'];
    /**
     * @param $type
     * @return mixed
     */

    /*public function status($status){
            return $this->builder->where('status',$status);
    }*/
    public function dateRange($dateRange){

        if($dateRange !='undefined' && !empty($dateRange)){
            $date = explode('to',$dateRange);
           // dd($date);
            $start=Carbon::parse($date[0])->format('Y-m-d');
            $end=Carbon::parse($date[1])->format('Y-m-d');
          // dd($start,$end);
           return $this->builder->whereBetween('created_at', [$start, $end]);
        }
    }

    public function month($month){
        //dd($month);
        if (isset($month) && !empty($month)){
            return $this->builder->whereMonth('date',$month);
        }
    }

    /*public function subscriberId($generalSearch){
        dd($generalSearch);
        if($generalSearch !='undefined' && !empty($generalSearch)){
            return $this->builder->with(['user'=>function($query) use ($generalSearch){
                $query->where('name', 'like', '%'.$generalSearch.'%')
                    ->orWhere('email', 'like', '%'.$generalSearch.'%');
            }]);
        }

    }*/
   /* public function userName($userName){
        dd($userName);
        return $this->builder->where(function ($query) use ($userName) {
            $query->where('name', 'like', '%'.$userName.'%')
                ->orWhere('email', 'like', '%'.$userName.'%');
        });
    }*/
}
