<?php

namespace App\Http\Controllers\Admin;

use App\Model\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderBy('created_at','desc')->get();
        return view('admin.link.links',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.linkCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $link = new Link();
        $link->name = $request->name;
        $link->url = $request->url;
        $link->logo = $request->linklogo;
        $link->save();
        return response()->json(['code'=>200]);
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
        $link = Link::find($id);
        return view('admin.link.linkEdit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
        $link = Link::find($id);
        $link->name = $request->name;
        $link->url = $request->url;
        $link->logo = $request->linklogo;
        $link->save();
        return response()->json(['code'=>200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::destroy($id);
        return response()->json(['code'=>200]);
    }

    //处理linklogo上传封面
    public function linklogo(Request $request)
    {
        $path = $request->file('linklogo')->store('/public/linklogo');
        $path = '/storage/linklogo' . substr($path, 15);
        return response()->json(['path' => $path]);
    }
}
