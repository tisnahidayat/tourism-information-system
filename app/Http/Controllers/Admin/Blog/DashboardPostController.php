<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Post;
use App\Models\Katpost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardPostController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Post',
            'post' => Post::all()
        ];

        return view('admin.blog.post.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah'
        ];

        return view('admin.blog.post.create', $data);
    }

    public function show(Post $posting)
    {
        $data = [
            'title' => 'Detail Blog',
            'post' => $posting,
        ];
        return view('admin.blog.post.show', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:5000'
        ]);
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        }
        $validatedData['id_user'] = auth()->user()->id;
        Post::create($validatedData);
        return redirect()->route('posting.index')->with('success', 'Postingan berhasil ditambahkan.');
    }


    public function edit(Post $posting)
    {
        return view('admin.blog.post.edit', [
            'title' => 'Edit',
            'post' => $posting
        ]);
    }

    public function update(Request $request, Post $posting)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($posting->id)],
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'gambar' => 'image|file|max:5000'
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($posting->gambar) {
                Storage::delete('public/' . $posting->gambar);
            }

            $file = $request->file('gambar')->store('gambar');
            $data['gambar'] = str_replace('storage/', '', $file);
        }

        $data['id_kategori'] = $request->kategori;
        $data['id_user'] = Auth::id();
        $posting->update($data);

        return redirect()->route('posting.index')->with('success', 'Post berhasil diperbarui.');
    }


    public function destroy(Post $posting)
    {
        if ($posting->gambar) {
            Storage::delete('public/' . $posting->gambar);
        }
        $posting->delete();

        return redirect('/dashboard/posting')->with('success', 'Postingan Berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
