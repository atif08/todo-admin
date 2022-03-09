<?php
/**
 * Created by PhpStorm.
 * User: Atif
 * Date: 3/5/2020
 * Time: 1:01 PM
 */

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {

        $this->builder = $builder;
        foreach ($this->getFilters() as $filter =>$value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }
    public function getFilters()
    {
        $collection = collect($this->request->all());
        $sort = $this->request->sort;
        if(!empty($sort)){
            $this->builder->orderBy($sort['field'],$sort['sort']);
        }else{
            $this->builder->orderBy('id','DESC');
        }
        if(!empty($collection)){
             return $collection;
         }else{
             return [];
         }
//        return $this->request->only($this->filters);
    }


}
