<?php

namespace App\Http\Controllers\Backend\Headers;


use App\Models\Header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class HeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = Header::all();

        return view('backend.headers.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headers = Header::all();
        if (count($headers) > 0) {
            return redirect()->route('admin.headers.index')->with('success', 'No need to add more !');
        }
        return view('backend.headers.create');
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
            'cart_icon' => 'required|string',
            'contact_icon' => 'required|string',
            'contact_number' => 'required|string',
            'button_name' => 'required|string',
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $request->validate([
                'logo' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            $logo_name = date("Ymdhis") . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(140, 36)->save(base_path('public/images/' . $logo_name), 100);
            $header = new Header();
            $header->logo = $logo_name;
            $header->cart_icon = $request->cart_icon;
            $header->contact_icon = $request->contact_icon;
            $header->contact_number = $request->contact_number;
            $header->button_name = $request->button_name;
            $header->save();
        } else {
            $header = new Header();
            $header->cart_icon = $request->cart_icon;
            $header->contact_icon = $request->contact_icon;
            $header->contact_number = $request->contact_number;
            $header->button_name = $request->button_name;
            $header->save();
        }

        return redirect()->route('admin.headers.index')->with('success', 'Data is successfully saved');
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
        $header = Header::findOrFail($id);
        return view('backend.headers.edit', compact('header'));
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
        $request->validate([
            'cart_icon' => 'required|string',
            'contact_icon' => 'required|string',
            'contact_number' => 'required|string',
            'button_name' => 'required|string',
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $request->validate([
                'logo' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            if (Header::find($id)->logo != 'logo.png') {
                $link = base_path('public/images/' . Header::find($id)->logo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $logo_name = date("Ymdhis") . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(140, 36)->save(base_path('public/images/' . $logo_name), 100);
            $header = Header::findOrFail($id);
            $header->logo = $logo_name;
            $header->cart_icon = $request->cart_icon;
            $header->contact_icon = $request->contact_icon;
            $header->contact_number = $request->contact_number;
            $header->button_name = $request->button_name;
            $header->save();
        } else {
            $header =  Header::findOrFail($id);
            $header->cart_icon = $request->cart_icon;
            $header->contact_icon = $request->contact_icon;
            $header->contact_number = $request->contact_number;
            $header->button_name = $request->button_name;
            $header->save();
        }
        return redirect()->route('admin.headers.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Header::findOrFail($id);
        $destroy->delete();
        if ($destroy->logo != 'logo.png') {
            $link = base_path('public/images/' . $destroy->logo);
            if (file_exists($link)) {
                unlink($link);
            }
        }
        return redirect()->route('admin.headers.index')->with('success', 'Data is successfully deleted');
    }
}
