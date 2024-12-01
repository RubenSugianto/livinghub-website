<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; 
use App\Models\Document; 

class DocumentController extends Controller
{
    public function edit($property_id)
    {
        $property = Property::findOrFail($property_id);
        $document = Document::where('property_id', $property_id)->first();

        return view('properties.document', compact('property', 'document'));
    }

    public function update(Request $request, $property_id)
    {
        $property = Property::findOrFail($property_id);
        $document = Document::where('property_id', $property_id)->firstOrFail();

        $request->validate([
            'documentType' => 'required|string|max:50',
            'customType' => 'nullable|string|max:50',
            'documentName' => 'required|string|max:100',
            'document' => 'required|mimes:pdf|max:5120',
        ]);

        $documentType = $request->input('documentType');
        if ($documentType === 'Lainnya') {
            $documentType = $request->input('customType');  // Use the custom document type
        }

        $document->type = $documentType;
        $document->name = $request->input('documentName');
    
        if ($document->status == 'Not Uploaded') {
            $document->status = 'Pending';
        }

        if ($document->status == 'Approved') {
            // Delete the existing file if it exists
            if ($document->file) {
                $filePath = public_path(str_replace('/', DIRECTORY_SEPARATOR, 'storage/documents/' . $document->file));
                if (file_exists($filePath)) {
                    unlink($filePath); 
                }
                $document->file = null;
            }
    
            $document->status = 'Pending';
        }
    
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $fileName = basename($documentPath);
            $document->file = $fileName;
        }
    
        $document->save();
    
        return redirect()->route('myproperties')->with('success', 'Dokumen berhasil diperbarui.');
    }
    
}
