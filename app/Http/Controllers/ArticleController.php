<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'sort']);
        $query = Articles::with('users');

        return inertia('Article/Index', [
            'filters' => $request->only(['search', 'sort']),
            'articles' => $query->filter($filters)
            ->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filename = '';
        if($request->hasFile('images')){
            foreach ($request->file('images') as $file) {
                $path = $file->store('articles', 'public');
                $filename = $file->hashName();
            }
        }
        $request->merge([
            'user_id' => Auth::user()->id,
            'image' => $filename
        ]);
        Articles::create($request->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:5',
                'image' => 'required',
                'user_id' => 'required',
            ])
        );
        return redirect()->route('articles.user')
        ->with('success', 'Article was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article)
    {
        return inertia('Article/Show', [
            'article' => Articles::with('users')->where('id', '=', $article->id)->first(),
            'comments' => Comments::with(['replies','users'])
            ->where('article_id', '=', $article->id)
            ->whereNull('comment_reply_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(3),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        return inertia('Article/Edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $article->update($request->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:5',
                'user_id' => 'required',
            ])
        );
        return redirect()->route('articles.user')
        ->with('success', 'Article was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        Storage::disk('public')->delete('articles/'.$article->image);
        $article->delete();

        return redirect()->back()
        ->with('success', 'Article was deleted');
    }

    public function myArticles(Request $request){
        $filters = $request->only(['search', 'sort']);
        return inertia('Article/MyArticle', [
            'filters' => $request->only(['search', 'sort']),
            'articles' => Articles::where('user_id', '=', Auth::user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10),
        ]);
    }
}
