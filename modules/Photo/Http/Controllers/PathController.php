<?php


use App\Http\Controllers\Controller;
use App\Models\Path;
use Illuminate\Http\Request;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paths = Path::orderBy('path')->get();

        return [
            'data' => $paths->toArray(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = new Path;
        $path->fill($request->all());
        $path->save();

        return [
            'data' => $path->toArray(),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Path $path)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Path $path)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Path $path)
    {
        $path->fill($request->all());
        $path->save();

        return [
            'data' => $path->toArray(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Path $path)
    {
        $path->delete();

        return [
            'data' => $path->toArray(),
        ];
    }
}
