<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = Archive::with(['category', 'user'])
            ->where('user_id', auth()->id());

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('file_name', 'like', '%' . $search . '%');
            });
        }

        $archives = $query->latest()->paginate(12);

        $categories = Category::all();

        return view('archives.index-frozen', compact('archives', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('archives.create-frozen', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|max:51200', // 50MB max
            'is_private' => 'boolean',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();

        // Generate unique file name
        $uniqueFileName = Str::uuid() . '_' . time() . '.' . $fileExtension;

        // Store file
        $filePath = $file->storeAs('archives/' . auth()->id(), $uniqueFileName, 'private');

        Archive::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_type' => $fileExtension,
            'file_size' => $fileSize,
            'is_private' => $request->boolean('is_private', true),
        ]);

        return redirect()->route('archives.index')
            ->with('success', 'Arsip berhasil diupload! ❄️');
    }

    public function show(Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this archive.');
        }

        return view('archives.show-frozen', compact('archive'));
    }

    public function edit(Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('archives.edit-frozen', compact('archive', 'categories'));
    }

    public function update(Request $request, Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_private' => 'boolean',
        ]);

        $archive->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'is_private' => $request->boolean('is_private', true),
        ]);

        return redirect()->route('archives.show', $archive)
            ->with('success', 'Arsip berhasil diupdate! ❄️');
    }

    public function destroy(Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete file
        if (Storage::disk('private')->exists($archive->file_path)) {
            Storage::disk('private')->delete($archive->file_path);
        }

        $archive->delete();

        return redirect()->route('archives.index')
            ->with('success', 'Arsip berhasil dihapus! ❄️');
    }

    public function download(Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403);
        }

        if (!Storage::disk('private')->exists($archive->file_path)) {
            abort(404, 'File not found.');
        }

        $filePath = Storage::disk('private')->path($archive->file_path);

        // For images and videos, return inline for preview/play
        if ($archive->isImage() || $archive->isVideo()) {
            return response()->file($filePath, [
                'Content-Type' => Storage::disk('private')->mimeType($archive->file_path),
                'Accept-Ranges' => 'bytes',
            ]);
        }

        // For PDF, return inline
        if ($archive->isPdf()) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $archive->file_name . '"',
            ]);
        }

        // For other files, force download
        return response()->download($filePath, $archive->file_name);
    }

    public function forceDownload(Archive $archive)
    {
        // Check authorization
        if ($archive->user_id !== auth()->id()) {
            abort(403);
        }

        if (!Storage::disk('private')->exists($archive->file_path)) {
            abort(404, 'File not found.');
        }

        $filePath = Storage::disk('private')->path($archive->file_path);
        
        return response()->download($filePath, $archive->file_name);
    }

    public function filterByCategory(Category $category)
    {
        $archives = Archive::with(['category', 'user'])
            ->where('user_id', auth()->id())
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('archives.index-frozen', compact('archives', 'categories', 'category'));
    }
}
