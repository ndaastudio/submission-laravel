<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $data = [
            'breadcrumbs' => [
                ['name' => 'Tag', 'url' => '/dashboard/tag'],
            ],
            'tags' => Tag::paginate(5)
        ];
        return view('dashboard.tag.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_tag' => 'required|unique:tags,nama_tag|min:3|max:255',
            ],
            [
                'nama_tag' => [
                    'required' => 'Nama tag harus diisi',
                    'unique' => 'Nama tag sudah ada',
                    'min' => 'Nama tag minimal 3 karakter',
                    'max' => 'Nama tag maksimal 255 karakter',
                ]
            ]
        );

        $isCreated = Tag::create($validatedData);
        if ($isCreated) {
            return redirect()->back()->with('success', 'Tag telah ditambahkan');
        }
        return redirect()->back()->with('error', 'Tag gagal ditambahkan');
    }

    public function delete(string $id)
    {
        $isDeleted = Tag::find($id)->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Tag telah dihapus');
        }
        return redirect()->back()->with('error', 'Tag gagal dihapus');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'nama_tag' => 'required|unique:tags,nama_tag,' . $id . '|min:3|max:255',
            ],
            [
                'nama_tag' => [
                    'required' => 'Nama tag harus diisi',
                    'unique' => 'Nama tag sudah ada',
                    'min' => 'Nama tag minimal 3 karakter',
                    'max' => 'Nama tag maksimal 255 karakter',
                ]
            ]
        );

        $isUpdated = Tag::find($id)->update($validatedData);
        if ($isUpdated) {
            return redirect()->back()->with('success', 'Tag telah diubah');
        }
        return redirect()->back()->with('error', 'Tag gagal diubah');
    }
}
