<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or Imagick if installed

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
//     public function testImage()
// {
//     // Create manager (using GD by default, you can use Imagick if installed)
//     $manager = new ImageManager(new Driver());

//     // Create a red 400x400 canvas
//     $image = $manager->create(400, 400)->fill('#ff0000');

//     // Save it
//     $filename = 'test_' . time() . '.jpg';
//     $path = public_path('gallery/' . $filename);

//     $image->save($path);

//     dd("✅ Image created at: $path");
// }    was use to test intervention image php extension. DO NOT USE IT . JAVASCRIPT IS BETTER


/**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
 $sort = $request->get('sort', 'desc'); // default: most recent

    $galleries = Gallery::orderBy('created_at', $sort)->get();

    return view('admin.galleries.index', compact('galleries', 'sort'));

}
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
 {
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('/galleries','public');
        $gallery = Gallery::create([
            'image_path' => $path
        ]);
        return response()->json([
            'success' => true,
            'gallery' => $gallery
        ],200);
    }

    return response()->json(['success' => false], 400);
 }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
         $sort = $request->get('sort', 'desc'); // default: most recent

    $galleries = Gallery::orderBy('created_at', $sort)->get();

    return view('gallery', compact('galleries', 'sort'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $gallery = Gallery::findOrFail($id);

    // Delete the file
    if ($gallery->filename && Storage::disk('public')->exists('galleries/' . $gallery->filename)) {
        Storage::disk('public')->delete('galleries/' . $gallery->filename);
    }

    // Delete from DB
    $gallery->delete();

    return response()->json(['success' => true]);
}

}
