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
            'documentType' => 'required|string',
            'documentName' => 'required|string',
            'document' => 'nullable|mimes:pdf|max:10240',
        ]);
    
        $document->type = $request->input('documentType');
    
        $document->name = $request->input('documentName');
    
        if ($document->status == 'Not Uploaded') {
            $document->status = 'Pending';
        }
    
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $document->file = $documentPath;
        }
    
        $document->save();
    
        return redirect()->route('myproperties.index')->with('success', 'Document updated successfully.');
    }
    
}
