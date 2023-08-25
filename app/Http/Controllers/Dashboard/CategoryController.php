<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'breadcrumbs' => [
                ['name' => 'Kategori', 'url' => '/dashboard/category'],
            ],
            'categories' => Category::paginate(5)
        ];
        return view('dashboard.category.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_kategori' => 'required|unique:categories,nama_kategori|min:3|max:255',
            ],
            [
                'nama_kategori' => [
                    'required' => 'Nama kategori harus diisi',
                    'unique' => 'Nama kategori sudah ada',
                    'min' => 'Nama kategori minimal 3 karakter',
                    'max' => 'Nama kategori maksimal 255 karakter',
                ]
            ]
        );

        $isCreated = Category::create($validatedData);
        if ($isCreated) {
            return redirect()->back()->with('success', 'Kategori telah ditambahkan');
        }
        return redirect()->back()->with('error', 'Kategori gagal ditambahkan');
    }

    public function destroy(string $id)
    {
        $isDeleted = Category::find($id)->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Kategori telah dihapus');
        }
        return redirect()->back()->with('error', 'Kategori gagal dihapus');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'nama_kategori' => 'required|unique:categories,nama_kategori,' . $id . '|min:3|max:255',
            ],
            [
                'nama_kategori' => [
                    'required' => 'Nama kategori harus diisi',
                    'unique' => 'Nama kategori sudah ada',
                    'min' => 'Nama kategori minimal 3 karakter',
                    'max' => 'Nama kategori maksimal 255 karakter',
                ]
            ]
        );

        $isUpdated = Category::find($id)->update($validatedData);
        if ($isUpdated) {
            return redirect()->back()->with('success', 'Kategori telah diubah');
        }
        return redirect()->back()->with('error', 'Kategori gagal diubah');
    }
}
