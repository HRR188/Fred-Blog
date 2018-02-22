<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Column;
use App\Model\Post;
class ColumnController extends Controller
{
    public function index()
    {
        $columns = column::all();
        return view('admin.column.column', compact('columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $column = new column();
        $column->name = $request->name;
        $column->save();
        return response()->json(['code' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Column::where('id', $id)->update(['name' => $request->name]);
        return response()->json(['code' => 200]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Column::destroy($id);
        return response()->json(['code' => 200]);
    }

    //还是amazi ui的钩子问题。。。
    public function showAllPosts($id)
    {
        $posts = Post::where('column_id', $id)->orderBy('updated_at', 'desc')->get();
        return response()->json(['posts' => $posts]);
    }
}
