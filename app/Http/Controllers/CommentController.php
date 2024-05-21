<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'message' => 'Create a new comment here.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);
        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $id)
    {
        $request->validate([
            'body' => 'sometimes|required',
            'post_id' => 'sometimes|required|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $id)
    {
        Comment::destroy($id);

        return response()->json(null, 204);
    }
}
