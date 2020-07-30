<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/**
 * @AnnotatedDescription(allow=false,desc="Post")
 */
class PostController extends Controller
{
    /**
     * @AnnotatedDescription(allow=true,desc="Display a listing of the resource.")
     */
    public function index()
    {
        return view('post::index');
    }


    /**
     * @AnnotatedDescription(allow=true,desc="Show the form for creating a new resource")
     */
    public function create()
    {
        return view('post::create');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Store a newly created resource in storage.")
     */

    public function store(Request $request)
    {
        //
    }


    /**
     * @AnnotatedDescription(allow=true,desc="Show the specified resource..")
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Show the form for editing the specified resource.")
     */
    public function edit($id)
    {
        return view('post::edit');
    }


    /**
     * @AnnotatedDescription(allow=true,desc="Update the specified resource in storage.")
     */

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Remove the specified resource from storage.")
     */


    public function destroy($id)
    {
        //
    }
}
