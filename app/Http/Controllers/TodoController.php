<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\HTTP;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
   

    public function index()
    {
       
        return Todo::all();
    }

    public function show($id)
    {
        return Todo::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Todo::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();  // Get the authenticated user
    
        // Find the todo, but also ensure it belongs to the authenticated user
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->firstOrFail();
    
        $todo->update($request->all());
    
        return $todo;
    }
    
    public function destroy(Request $request, $id)
    {
        $user = $request->user();  // Get the authenticated user
    
        // Find the todo, but also ensure it belongs to the authenticated user
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->firstOrFail();
    
        $todo->delete();
    
        return response(null, 204);  // HTTP 204 No Content
    }
    

    public function fetchFromJsonPlaceholder()
    {
        // Make a GET request to fetch todos from JSON Placeholder API
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');

        // Check if the request was successful (HTTP status code 2xx)
        if ($response->successful()) {
            // Parse the JSON response
            $todos = $response->json();

            // Handle the todos as needed
            return response()->json($todos);
        } else {
            // Handle the error if the request was not successful
            return response()->json(['error' => 'Failed to fetch todos'], $response->status());
        }
    }
}
