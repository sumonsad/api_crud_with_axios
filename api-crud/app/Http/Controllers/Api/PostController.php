<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Create a new post
    public function store(Request $request)
    {
        //Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        //Create and save the post
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'data' => $post,
            ]
        );

        // return response()->json([
        //     'form-request' => $request->all(),
        // ]); // Return created post with 201 status code
    }

    // Get all posts
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'data' => $posts,
        ]);
    }

    // Get a specific post by ID
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
                'error' => [],
            ], 404);
        }

        return response()->json([
            'success'=> true,
            'message' => "succesfull",
            'data'=>$post,
        ]);
    }

    // Update a specific post by ID
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->content,
        ]);

        return response()->json($post);
    }

    // Delete a specific post by ID
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}

?>
