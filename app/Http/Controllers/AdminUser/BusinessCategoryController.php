<?php

namespace App\Http\Controllers\AdminUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessCategory;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\File;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessCategory = Category::all();
        return view('admin.category.index', compact('businessCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $businessCategory = new Category();
     //   dd($request->all());
        $validator = validator::make($request->all(), [
            'name' => 'required|unique:categories|max:40',
            'icon' => 'required',
            'images' => 'required',
        ]);

        $businessCategory->name = $request->name;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $cover = $value;
                $extension = $cover->getClientOriginalExtension();
                $imagename = 'category_' . strtolower($request->name) . '.' . $extension;
                \Illuminate\Support\Facades\Storage::disk('public','categories')->put($imagename, File::get($cover));
                $businessCategory->image = $imagename;
            }
        }
        if($validator->passes()) {

            $businessCategory->save();

            Session::flash('success', 'Category has been created successfully.');
            //Session::flash('info', 'Tenant will be recieving an email for the account confirmation  ');
            return redirect()->route('business_category.index');
        }
        else{

            Session::flash('error', 'Fields with * must be filled.');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $businessCategory = Category::find($id);
        return view('admin.category.edit', compact('businessCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $businessCategory = Category::find($id);

        $validator = validator::make($request->all(), [
            'name' => 'required',
        ]);

        $businessCategory->name = $request->name;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('backend/img/'.$filename);
            // dd($location);
            Image::make($image)->resize(130, 130)->save($location);
            $oldfilename = $businessCategory->image;
            $businessCategory->image = $filename;
            Storage::delete($oldfilename);
        }

        if($validator->passes()) {

            $businessCategory->save();

            Session::flash('success', 'Category has been Updated successfully.');
            //Session::flash('info', 'Tenant will be recieving an email for the account confirmation  ');
            return redirect()->route('business_category.index');
        }
        else{

            Session::flash('error', 'Fields with * must be filled.');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Category::where('id',$id)->delete($id);

        Session::flash('success','Category has been deleted successfully');
        return redirect()->route('business_category.index');
    }
}
