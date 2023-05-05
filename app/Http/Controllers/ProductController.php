<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductsByUserId(Request $request)
    {
        return $this->productRepository->getProductsByUserId($request->all()['userId']);
    }

    public function postProductsByUserId(Request $request)
    {
        return $this->productRepository->getProductsByUserId($request->all()['products'],$request->all()['userId']); 
    }
}
