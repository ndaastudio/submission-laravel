<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Article;
use App\Models\UsedTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $queryForAdmin = Article::paginate(5);
        $queryForPenulis = Article::where('user_id', $userId)->paginate(5);
        $data = [
            'breadcrumbs' => [
                ['name' => 'Artikel', 'url' => '/dashboard/article'],
            ],
            'articles' => Auth::user()->role === 2 ? $queryForAdmin : $queryForPenulis,
        ];
        return view('dashboard.article.index', $data);
    }

    public function create()
    {
        $data = [
            'breadcrumbs' => [
                ['name' => 'Artikel', 'url' => '/dashboard/article'],
                ['name' => 'Tambah', 'url' => null],
            ],
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ];
        return view('dashboard.article.create', $data);
    }

    public function store(Request $request)
    {
        $validatedDataArticle = $request->validate(
            [
                'judul' => 'required|min:10|max:255',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'isi' => 'required|min:10',
                'category_id' => 'required',
                'deskripsi_singkat' => 'required|min:100|max:255',
            ],
            [
                'judul' => [
                    'required' => 'Judul harus diisi',
                    'min' => 'Judul minimal 10 karakter',
                    'max' => 'Judul maksimal 255 karakter',
                ],
                'gambar' => [
                    'required' => 'Gambar harus diisi',
                    'image' => 'Gambar harus berupa gambar',
                    'mimes' => 'Gambar harus berupa jpeg, png, jpg, gif, atau svg',
                    'max' => 'Gambar maksimal 2048 KB',
                ],
                'isi' => [
                    'required' => 'Isi harus diisi',
                    'min' => 'Isi minimal 10 karakter',
                ],
                'category_id' => [
                    'required' => 'Kategori harus dipilih',
                ],
                'deskripsi_singkat' => [
                    'required' => 'Deskripsi singkat harus diisi',
                    'min' => 'Deskripsi singkat minimal 100 karakter',
                    'max' => 'Deskripsi singkat maksimal 255 karakter',
                ],
            ]
        );

        try {
            DB::beginTransaction();
            $validatedDataArticle['user_id'] = Auth::user()->id;
            $validatedDataArticle['slug'] = Str::slug($validatedDataArticle['judul']);
            $validatedDataArticle['gambar'] = $request->file('gambar')->store('Gambar', 'public');
            $isCreatedArticle = Article::create($validatedDataArticle);

            $validatedDataTag = $request->validate(
                [
                    'tag' => 'required',
                ],
                [
                    'tag' => [
                        'required' => 'Tag harus dipilih',
                    ],
                ]
            );

            $tags = explode(',', $validatedDataTag['tag']);
            foreach ($tags as $tag) {
                UsedTag::create([
                    'article_id' => $isCreatedArticle->id,
                    'tag_id' => $tag
                ]);
            }
            DB::commit();
            return redirect()->route('article')->with('success', 'Artikel telah ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan artikel ' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $gambarName = Article::find($id)->gambar;
            if ($gambarName) {
                Storage::disk('public')->delete($gambarName);
            }
            Article::where('id', $id)->delete();
            UsedTag::where('article_id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Artikel telah dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus artikel ' . $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $data = [
            'breadcrumbs' => [
                ['name' => 'Artikel', 'url' => '/dashboard/article'],
                ['name' => 'Edit', 'url' => null],
            ],
            'article' => Article::find($id),
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ];
        return view('dashboard.article.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validatedDataArticle = $request->validate(
            [
                'judul' => 'required|min:10|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'isi' => 'required|min:10',
                'category_id' => 'required',
                'deskripsi_singkat' => 'required|min:100|max:255',
            ],
            [
                'judul' => [
                    'required' => 'Judul harus diisi',
                    'min' => 'Judul minimal 10 karakter',
                    'max' => 'Judul maksimal 255 karakter',
                ],
                'gambar' => [
                    'image' => 'Gambar harus berupa gambar',
                    'mimes' => 'Gambar harus berupa jpeg, png, jpg, gif, atau svg',
                    'max' => 'Gambar maksimal 2048 KB',
                ],
                'isi' => [
                    'required' => 'Isi harus diisi',
                    'min' => 'Isi minimal 10 karakter',
                ],
                'category_id' => [
                    'required' => 'Kategori harus dipilih',
                ],
                'deskripsi_singkat' => [
                    'required' => 'Deskripsi singkat harus diisi',
                    'min' => 'Deskripsi singkat minimal 100 karakter',
                    'max' => 'Deskripsi singkat maksimal 255 karakter',
                ],
            ]
        );

        try {
            DB::beginTransaction();
            $validatedDataArticle['user_id'] = Auth::user()->id;
            $validatedDataArticle['slug'] = Str::slug($validatedDataArticle['judul']);
            if ($request->hasFile('gambar')) {
                $gambarName = Article::find($id)->gambar;
                if ($gambarName) {
                    Storage::disk('public')->delete($gambarName);
                }
                $validatedDataArticle['gambar'] = $request->file('gambar')->store('Gambar', 'public');
            }
            Article::where('id', $id)->update($validatedDataArticle);

            if ($request->tag) {
                $tags = explode(',', $request->tag);
                UsedTag::where('article_id', $id)->delete();
                foreach ($tags as $tag) {
                    UsedTag::create([
                        'article_id' => $id,
                        'tag_id' => $tag
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('article')->with('success', 'Artikel telah diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah artikel ' . $th->getMessage());
        }
    }
}
