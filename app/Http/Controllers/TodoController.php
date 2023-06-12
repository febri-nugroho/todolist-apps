<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::latest()->get();
        return response([
            'success' => true,
            'message' => 'List All Todo List',
            'data' => $todo
        ], 200);
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
        //
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $todo = Todo::create($request->all());
        return [
            "status" => 1,
            "data" => $todo
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::whereId($id)->first();

        if ($todo) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Todo List!',
                'data'    => $todo
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Todo List Not Found!',
                'data'    => ''
            ], 404);
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'status'   => 'required',
        ],
            [
                'name.required' => 'Name Required !',
                'status.required' => 'Status Required !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input Required!',
                'data'    => $validator->errors()
            ],400);
        } else {
            $todo = Todo::whereId($request->input('id'))->update([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'status'        => $request->input('status'),
            ]);

            if ($todo) {
                return response()->json([
                    'success' => true,
                    'message' => 'Todo List Successfully Updated!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Update Failed',
                ], 500);
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
        $todo = Todo::findOrFail($id);
        $todo->delete();

        if ($todo) {
            return response()->json([
                'success' => true,
                'message' => 'Todo List Deleted!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Todo List Failed Delete!',
            ], 500);
        }
    }

    /**
     * Update Status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $todo = Todo::whereId($id)->update([
            'status' => 1,
        ]);

        if ($todo) {
            return response()->json([
                'success' => true,
                'message' => 'Status Successfully Updated!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Status Update Failed',
            ], 500);
        }
    }
}
