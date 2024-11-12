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
            $property->check = 'Approved'; // Ubah status menjadi Approved
            $property->save();
            return redirect()->back()->with('success', 'Properti berhasil disetujui.');
        }
        return redirect()->back()->with('error', 'Properti tidak ditemukan.');
    }

    public function rejectProperty($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->check = 'Rejected'; // Ubah status menjadi Rejected
            $property->save();
            return redirect()->back()->with('error', 'Properti berhasil ditolak.');
        }
        return redirect()->back()->with('error', 'Properti tidak ditemukan.');
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
            return redirect()->route('document.pending')->with('success', 'Dokumen berhasil disetujui.');
        }
        return redirect()->route('document.pending')->with('error', 'Dokumen tidak ditemukan.');
    }

    public function declineDocument($id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->status = 'Rejected'; // Ubah status menjadi 'Rejected'
            $document->save();
            return redirect()->route('document.pending')->with('success', 'Dokumen berhasil ditolak.');
        }
        return redirect()->route('document.pending')->with('error', 'Dokumen tidak ditemukan.');
    }

    public function dashboard()
    {
        return view('admin.admindashboard');
    }

    
}
