<?php

namespace App\Http\Controllers\Backend\Companys;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CompanysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companys = Company::all();

        return view('backend.companys.index', compact('companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.companys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $company = $request->file('image');
            $request->validate([
                'image' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            $company_name = date("Ymdhis") . '.' . $company->getClientOriginalExtension();
            Image::make($company)->resize(85, 100)->save(base_path('public/images/company/' . $company_name), 100);
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $company = new Company();
        $company->image = $company_name;
        if ($request->link) {
            $company->link = $request->link;
        }
        $company->status = $status;
        $company->save();
        return redirect()->route('admin.companys.index')->with('success', 'Data is successfully saved');
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
        $company = Company::findOrFail($id);
        return view('backend.companys.edit', compact('company'));
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
        if ($request->hasFile('image')) {
            $company = $request->file('image');
            $request->validate([
                'image' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            $company_name = date("Ymdhis") . '.' . $company->getClientOriginalExtension();
            $link = base_path('public/images/company/' . Company::find($id)->image);
            if (file_exists($link)) {
                unlink($link);
            }
            Image::make($company)->resize(85, 100)->save(base_path('public/images/company/' . $company_name), 100);
            $company = Company::findOrFail($id);
            $company->image = $company_name;
            $company->save();
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $company = Company::findOrFail($id);
        if ($request->link) {
            $company->link = $request->link;
        }
        $company->status = $status;
        $company->save();
        return redirect()->route('admin.companys.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Company::findOrFail($id);
        $destroy->delete();
        $link = base_path('public/images/company/' . $destroy->image);
        if (file_exists($link)) {
            unlink($link);
        }
        return redirect()->route('admin.companys.index')->with('success', 'Data is successfully deleted'); //
    }
}
