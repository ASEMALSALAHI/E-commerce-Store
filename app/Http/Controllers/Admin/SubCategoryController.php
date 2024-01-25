<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function AllSubCategory()
    {
        $subCategory = SubCategory::all();

        return view('backend.category.allsubcategory', compact('subCategory'));
    }
    public function AddSubCategory()
    {
        $Category = Category::all();

        return view('backend.category.addsubcategory', compact('Category'));

    }

    public function StoreSubCategory(Request $request)
    {
       $request->validate([
           'category_name' => 'required',
           'subcategory_name' => 'required',
           'subcategory_image' => 'required'

         ]);
         $file = $request->file('subcategory_image');
        // $file=avatar-1.png
        $originalName = $file->getClientOriginalName();
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $timestamp = date('YmdHis');
        $filename = $timestamp . '_' . $originalName;
        $file->move(public_path('upload/subcategory'),$filename);
        $save_url ='http://127.0.0.1:8000/upload/subcategory/'.$filename;
       subCategory::insert([
           'category_name' => $request->category_name,
           'subcategory_name' => $request->subcategory_name,
           'subcategory_image' => $save_url,
           ]);
        $notification = array(
           'message' => 'SubCategory Inserted Successfully',
           'alert-type' => 'success'
         );

       return redirect()->route('all.subcategories')->with($notification);

         }

         public function DeleteSubCategory($id){
             SubCategory::findOrFail($id)->delete();
             $notification = array(
                 'message' => 'subCategory Deleted Successfully',
                 'alert-type' => 'warning'
             );
             return redirect()->back()->with($notification);

         }


    public function EditSubCategory($id)
    {
        $Category = Category::orderBy('category_name', 'asc')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subCategory', 'Category'));

    }

    public function UpdateSubCategory(Request $request, $id)
    {
        if($request->file('subcategory_image')){

            $file = $request->file('subcategory_image');
            // $file=avatar-1.png
            $originalName = $file->getClientOriginalName();
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $timestamp = date('YmdHis');
            $filename = $timestamp . '_' . $originalName;

// Concatenate the extension only if it's not already present
            if (strpos($filename, '.' . $extension) === false) {
                $filename .= '.' . $extension;
            }

            //$filename=26.3.2022.png

            $file->move(public_path('upload/subcategory'), $filename);

            $save_url = 'http://127.0.0.1:8000/upload/subcategory/'.$filename ;



            SubCategory::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_image' =>  $save_url,
                'updated_at'=>Now()
            ]);

            $notification = array(
                'message' => 'SubCategory Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.subcategories')->with($notification);



        }else{

        SubCategory::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'subcategory_name' => $request->subcategory_name,
        ]);
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subcategories')->with($notification);

    }
}









    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_name',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);
    }

}
