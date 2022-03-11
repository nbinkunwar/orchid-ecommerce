<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categories()
    {
        $categories = Category::parentEmpty()->get();
        return new JsonResponse(['data'=>CategoryResource::collection($categories)]);
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        return new JsonResponse(['data'=>new CategoryResource($category)]);
    }

    public function brands()
    {
        $brands = Brand::all();
        return new JsonResponse(['data'=>BrandResource::collection($brands)]);
    }

    public function products(Request $request)
    {
        $limit = $request->get('limit',10);
        $categories = [];
        $products = Product::orderBy('id','desc')->active()->paginate($limit);
        return new JsonResponse(['data'=>new ProductCollection($products)]);
    }

    public function product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return new JsonResponse(['data'=>new ProductResource($id)]);
    }
}
