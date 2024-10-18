<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Document;

class AdminController extends Controller
{
    

    public function showPendingProperties()
    {
        // Fetch properties where 'check' status is 'Pending' along with their images
        $pendingProperties = Property::with('images')->where('check', 'Pending')->paginate(10);

        $title = "Pending Properties";
        
        // Return view with the pending properties data
        return view('admin.adminproperty', compact('pendingProperties', 'title'));
    }

    public function approveProperty($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->status = 'Approved'; // Ubah status menjadi Approved
            $property->save();
            return redirect()->back()->with('success', 'Property approved successfully.');
        }
        return redirect()->back()->with('error', 'Property not found.');
    }

    public function rejectProperty($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->status = 'Rejected'; // Ubah status menjadi Rejected
            $property->save();
            return redirect()->back()->with('error', 'Property rejected.');
        }
        return redirect()->back()->with('error', 'Property not found.');
    }

    public function showDocuments()
    {
        $documents = Document::where('status', 'Pending')->with('property')->paginate(10); // Ambil dokumen dengan status Pending
        $pendingProperties = Property::with('images')->where('check', 'Pending')->paginate(10);
        
        return view('admin.admindocument', [
            'title' => 'Approve Documents',
            'documents' => $documents,
            'pendingProperties' => $pendingProperties, // Kirim data ini ke view
        ]);
    }

    public function approveDocument($id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->status = 'Approved'; // Ubah status menjadi 'Approved'
            $document->save();
            return redirect()->route('document.approve')->with('success', 'Document approved successfully.');
        }
        return redirect()->route('document.approve')->with('error', 'Document not found.');
    }

    public function declineDocument($id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->status = 'Declined'; // Ubah status menjadi 'Declined'
            $document->save();
            return redirect()->route('document.approve')->with('success', 'Document declined successfully.');
        }
        return redirect()->route('document.approve')->with('error', 'Document not found.');
    }

    public function dashboard()
    {
        return view('admin.admindashboard');
    }

}
