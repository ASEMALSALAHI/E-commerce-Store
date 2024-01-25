<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\ProductList;
use Illuminate\Http\Request;
use App\Models\SubCategory;


class user_CategoryController extends Controller
{
    //
    public function AllCategory()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);

    }

    public function CategoryById($id)
    {
 
        $category = Category::find($id);


        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return new CategoryResource($category);
    }

    public function subCategoryById($id)
    {

        $categoryn = Category::find($id);
        $categoryname = $categoryn->category_name;
        $subCategories = SubCategory::where('category_name', $categoryname)->get();

        if (!$subCategories) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json( [$subCategories]);
    }


    public function productbysubcategore($id)
    {

        $subcategory = SubCategory::find($id);
        $subcategorynames = $subcategory->subcategory_name;
        $pruductli = ProductList::where('subcategory', $subcategorynames)->get();

        if (!$pruductli) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json( [$pruductli]);
    }






}
