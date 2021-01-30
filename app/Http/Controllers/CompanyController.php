<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::all();

        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',

        ]);

        $contact = new Company([
            'name' => $request->get('name'),
            'logo' => $request->get('logo'),
            'email' => $request->get('email'),
            'website' => $request->get('website'),

        ]);
        $contact->save();
        return redirect('/company/index')->with('success', 'Company saved!');
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
        //
        $company = Company::find($id);
        return view('company.edit', compact('company'));
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
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'website'=>'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',

        ]);

        $company = Company::find($id);
        $company->name =  $request->get('name');
        $company->website = $request->get('website');
        $company->email = $request->get('email');

        if ($company->save()){
            if($request->hasFile('logo')){

                // check if user had an image
                if (!empty($company->logo)){
                    //delete current image
                    \Illuminate\Support\Facades\File::delete([$company->logo]);
                    Storage::delete([$company->logo]);
                }
                $path = $request->file('logo')->store('/uploads/logos');
                $file = $request->file('logo');
                $destinationPath = 'uploads/logos/';
                $file->move($destinationPath, $path);

                $company->logo = $path;
                $company->save();

                return redirect('/company/index')->with('success', 'Company updated!');
            }
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
        //
        $company = Company::find($id);
        $company->delete();

        return redirect('/company/index')->with('success', 'Company deleted!');
    }
}
