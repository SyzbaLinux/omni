<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return Course::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'meta' => 'required',
            'cost' => 'required',
        ]);

        if ($data->fails()) {
            return response()->json(
                [
                    'errors' => $data->errors(),
                ], 422);
        }


        if($request->image){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('storage/').$name);
            $named = '/storage/'.$name;


            $request->merge(['image' => $named]);

            // $img = Image::make('foo.jpg')->resize(300, 200);
        }else{
            $request->merge(['image' => '/storage/course.png']);
        }

        $course = new Course();

        $course->title = $request->title;
        $course->image = $request->image;
        $course->meta = $request->meta;
        $course->cost = $request->cost;

        $course->save();

        return response()->json([
            'status'  =>'success',
            'message' => 'New Course added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'meta' => 'required',
            'cost' => 'required',
        ]);

        if ($data->fails()) {
            return response()->json(
                [
                    'errors' => $data->errors(),
                ], 422);
        }


        if($request->image){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('storage/').$name);
            $named = '/storage/'.$name;


            $request->merge(['image' => $named]);

            // $img = Image::make('foo.jpg')->resize(300, 200);
        }else{
            $request->merge(['image' => '/storage/course.png']);
        }

        $course =   Course::where('id', $request->id);

        $course->title = $request->title;
        $course->image = $request->image;
        $course->meta = $request->meta;
        $course->cost = $request->cost;

        $course->save();

        return response()->json([
            'status'  =>'success',
            'message' => 'New Course added Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
