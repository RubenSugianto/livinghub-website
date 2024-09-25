<?php
// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Document;
use App\Models\Like;
use App\Models\Favourite;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    // Mengambil semua properti
    public function index()
    {
        $properties = Property::all();
        return view('home', compact('properties'));
    }

    // Menampilkan detail properti
    public function show(Property $property)
    {
        $propertyImages = PropertyImage::where('property_id', $property->id)->get();
        return view('property', compact('property', 'propertyImages'));
    }

    // Menampilkan form untuk menambahkan properti
    public function add()
    {
        return view('addproperty');
    }

    // Menyimpan properti baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'electricity' => 'required|integer',
            'surfaceArea' => 'required|integer',
            'buildingArea' => 'required|integer',
            'status' => 'required|string',
            'typeProperty' => 'required|string',
            'typeDocument' => 'required|string',
            'published_at' => 'nullable|date',
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        // Membuat properti baru
        $property = new Property();
        $property->id = (string) Str::uuid(); // Generate UUID untuk id field
        $property->user_id = auth()->id();
        $property->name = $request->name;
        $property->price = $request->price;
        $property->location = $request->location;
        $property->description = $request->description;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->electricity = $request->electricity;
        $property->surfaceArea = $request->surfaceArea;
        $property->buildingArea = $request->buildingArea;
        $property->status = $request->status;
        $property->check = 'Pending';
        $property->type = $request->typeProperty;
        $property->published_at = $request->published_at ?? now(); // Default to current timestamp if not provided

        $property->save();

        // Menyimpan gambar properti
        if($files = $request->file('images')) {
            foreach($files as $key => $file) {
                $extension = $file ->getClientOriginalExtension();
                $filename = $key. '-' .time(). '.'. $extension;
                $path = 'uploads/properties/';
                $file->move($path, $filename);

                PropertyImage::create([
                    'property_id' => $property->id,
                    'user_id' => auth()->id(),
                    'images' => $path . $filename,
                ]);
            }
        }

        // Membuat dokumen properti
        Document::create([
            'property_id' => $property->id,
            'user_id' => auth()->id(),
            'type' => $request->typeDocument,
            'status' => 'Not Uploaded'
        ]);

        return redirect()->route('home')->with('success', 'Property added successfully.');
    }

     // Show the form for editing a specific property
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $propertyImages = PropertyImage::where('property_id', $id)->get(); // Add this line
        $imageIds = $propertyImages->pluck('id'); // Get only the IDs

        return view('properties.edit', compact('property', 'propertyImages', 'imageIds')); // Update this line
    }
 
     // Update a specific property
     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'price' => 'required|integer',
             'location' => 'required|string|max:255',
             'description' => 'required|string',
             'bedroom' => 'required|integer',
             'bathroom' => 'required|integer',
             'electricity' => 'required|integer',
             'surfaceArea' => 'required|integer',
             'buildingArea' => 'required|integer',
             'status' => 'required|string|max:50',
             'type' => 'required|string|max:50',
             'images.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
             'existing_images' => 'array', // Array of existing image IDs (hidden inputs in the form)
         ]);
     
         $property = Property::findOrFail($id);
         $property->update($request->except('images', 'existing_images'));
     
         // Handle existing images
         $existingImageIds = $request->input('existing_images', []);
         $currentImageIds = $property->images->pluck('id')->toArray();
     
         // Delete images that are no longer in the existing_images list
         foreach (array_diff($currentImageIds, $existingImageIds) as $imageId) {
             $image = PropertyImage::find($imageId);
             if ($image) {
                 Storage::delete($image->images);
                 $image->delete();
             }
         }
     
         // Handle newly uploaded images
         if ($files = $request->file('images')) {
             foreach ($files as $file) {
                 $filename = time() . '-' . $file->getClientOriginalName();
                 $path = 'uploads/properties/';
                 $file->move($path, $filename);
     
                 PropertyImage::create([
                     'property_id' => $property->id,
                     'user_id' => auth()->id(),
                     'images' => $path . $filename,
                 ]);
             }
         }
     
         return redirect()->route('myproperties.index')->with('success', 'Property updated successfully.');
     }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Check and delete related likes
        $likes = Like::where('property_id', $property->id)->get();
        if ($likes->isNotEmpty()) {
            Like::where('property_id', $property->id)->delete();
        }

        // Check and delete related favorites
        $favorites = Favourite::where('property_id', $property->id)->get();
        if ($favorites->isNotEmpty()) {
            Favourite::where('property_id', $property->id)->delete();
        }

        // Check and delete related property images
        $propertyImages = PropertyImage::where('property_id', $property->id)->get();
        if ($propertyImages->isNotEmpty()) {
            PropertyImage::where('property_id', $property->id)->delete();
        }

        // Check and delete related documents
        $documents = Document::where('property_id', $property->id)->get();
        if ($documents->isNotEmpty()) {
            Document::where('property_id', $property->id)->delete();
        }

        // Delete the property
        $property->delete();

        return redirect()->route('myproperties.index')->with('success', 'Property deleted successfully');
    }


    // Mencari properti berdasarkan filter
    public function search(Request $request)
    {
        $query = Property::query();

        // Filter berdasarkan berbagai field
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('location', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('price', 'LIKE', "%{$search}%")
                      ->orWhere('status', 'LIKE', "%{$search}%")
                      ->orWhere('type', 'LIKE', "%{$search}%");
            });
        }

        // Filter tambahan berdasarkan field individual
        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        if ($request->has('bedrooms') && $request->input('bedrooms') != '') {
            $bedrooms = $request->input('bedrooms');
            switch ($bedrooms) {
                case '1 Kamar':
                    $query->where('bedroom', 1);
                    break;
                case '2 Kamar':
                    $query->where('bedroom', 2);
                    break;
                case '3 Kamar':
                    $query->where('bedroom', 3);
                    break;
                case '3+ Kamar':
                    $query->where('bedroom', '>=', 3);
                    break;
            }
        }

        if ($request->has('bathrooms') && $request->input('bathrooms') != '') {
            $bathrooms = $request->input('bathrooms');
            switch ($bathrooms) {
                case '1 Kamar':
                    $query->where('bathroom', 1);
                    break;
                case '2 Kamar':
                    $query->where('bathroom', 2);
                    break;
                case '3 Kamar':
                    $query->where('bathroom', 3);
                    break;
                case '3+ Kamar':
                    $query->where('bathroom', '>=', 3);
                    break;
            }
        }

        if (($request->has('land_size_min') && $request->input('land_size_min') != '') || ($request->has('land_size_max') && $request->input('land_size_max') != '')) {
            $landSizeMin = $request->input('land_size_min', 0);
            $landSizeMax = $request->input('land_size_max', PHP_INT_MAX);
            $query->whereBetween('surfaceArea', [$landSizeMin, $landSizeMax]);
        }

        if (($request->has('building_size_min') && $request->input('building_size_min') != '') || ($request->has('building_size_max') && $request->input('building_size_max') != '')) {
            $buildingSizeMin = $request->input('building_size_min', 0);
            $buildingSizeMax = $request->input('building_size_max', PHP_INT_MAX);
            $query->whereBetween('buildingArea', [$buildingSizeMin, $buildingSizeMax]);
        }

        if ($request->has('property_type') && $request->input('property_type') != '') {
            $propertyType = $request->input('property_type');
            $query->where('type', $propertyType);
        }
        
        if ($request->has('kota')) {
            $kota = $request->input('kota');
            $query->where('location', 'LIKE', "%{$kota}%");
        }

        // Paginasi hasil pencarian
        $properties = $query->paginate(2);

        return view('search-results', compact('properties'));
    }

    // Menambahkan properti ke favorit
  // Add to Favorites

 
      // Add to Favorites
      public function favorite(Property $property)
      {
          Favourite::firstOrCreate([
              'user_id' => auth()->id(),
              'property_id' => $property->id,
          ], [
              'id' => (string) Str::uuid(),
              'created_at' => now(),
              'updated_at' => now(),
          ]);
  
          return response()->json([
              'success' => true,
              'message' => 'Property added to favorites.'
          ]);
      }
  
      // Remove from Favorites
      public function unfavorite(Property $property)
      {
          $favourite = Favourite::where('user_id', auth()->id())
              ->where('property_id', $property->id)
              ->first();
  
          if ($favourite) {
              $favourite->delete();
              return response()->json([
                  'success' => true,
                  'message' => 'Property removed from favorites.'
              ]);
          }
  
          return response()->json([
              'success' => false,
              'message' => 'Property not found in favorites.'
          ]);
      }
  
      // View Favorite Properties
      public function favorites()
      {
          $favorites = auth()->user()->favorites()->get();
          return view('favourites', compact('favorites'));
      }
  // Like a Property
public function like(Property $property)
{
    Like::firstOrCreate([
        'user_id' => auth()->id(),
        'property_id' => $property->id,
    ], [
        'id' => (string) Str::uuid(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Property liked successfully.'
    ]);
}

// Unlike a Property
public function unlike(Property $property)
{
    $like = Like::where('user_id', auth()->id())
        ->where('property_id', $property->id)
        ->first();

    if ($like) {
        $like->delete();
        return response()->json([
            'success' => true,
            'message' => 'Property unliked successfully.'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Property not found in likes.'
    ]);
}

// View Liked Properties
public function likes()
{
    $likes = auth()->user()->likes()->get();
    return view('likes', compact('likes'));
}

// Get Like Count for a Property
public function likeCount(Property $property)
{
    $count = $property->likes()->count(); // Hitung jumlah like untuk properti ini

    return response()->json([
        'success' => true,
        'count' => $count,
    ]);
}

      // Compare properties
      public function compare(Request $request)
      {
          $propertyIds = $request->input('propertyIds');
          $properties = Property::whereIn('id', $propertyIds)->get();
  
          return response()->json($properties);
      }
  
      // Show comments of a property
      public function showComment($id)
      {
          $property = Property::with('comments')->findOrFail($id);
          return view('properties.showComment', compact('property'));
      }
  }
  