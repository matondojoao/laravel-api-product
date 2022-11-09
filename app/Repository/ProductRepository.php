<?php

namespace ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ProductRepository{

    private $model;
    public function __construct(Model $model ,Request $request)
    {
        
    }
}