<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::where('is_arsip', 0)
            ->orderByRaw("CASE WHEN status = 'new' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        $counts = Inquiry::selectRaw("
            SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count,
            SUM(CASE WHEN status = 'potential' THEN 1 ELSE 0 END) as potential_count,
            SUM(CASE WHEN status = 'archived' OR is_arsip = 1 THEN 1 ELSE 0 END) as archived_count
        ")
            ->first();

        return view('admin.inquiry.list', [
            'title' => 'Inquiry List',
            'inquiries' => $inquiries,
            'newCount'     => $counts->new_count,
            'potentialCount' => $counts->potential_count,
            'archivedCount'  => $counts->archived_count,
        ]);
    }

    public function archived()
    {
        $inquiries = Inquiry::where('is_arsip', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        $counts = Inquiry::selectRaw("
            SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count,
            SUM(CASE WHEN status = 'potential' THEN 1 ELSE 0 END) as potential_count,
            SUM(CASE WHEN status = 'archived' OR is_arsip = 1 THEN 1 ELSE 0 END) as archived_count
        ")
            ->first();

        return view('admin.inquiry.list', [
            'title' => 'Inquiry List',
            'inquiries' => $inquiries,
            'newCount'     => $counts->new_count,
            'potentialCount' => $counts->potential_count,
            'archivedCount'  => $counts->archived_count,
        ]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'whatsapp'            => 'nullable|string|max:50',
            'phone'               => 'nullable|string|max:50',
            'fish_name'           => 'nullable|string|max:255',
            'latin_name'          => 'nullable|string|max:255',
            'freezing_method'     => 'nullable|string|max:255',
            'size'                => 'nullable|string|max:255',
            'qty'                 => 'nullable|string|max:50',
            'port_of_destination' => 'nullable|string|max:255',
            'status'              => 'required|in:new,read,potential,archived',
            'note'                => 'nullable|string',
        ]);

        // 🔑 Logic status → arsip
        $validated['is_arsip'] = $validated['status'] === 'archived' ? 1 : 0;

        $inquiry->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Inquiry successfully updated.');
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,read,potential,archived',
        ]);

        $data = [
            'status'   => $request->status,
            'is_arsip' => $request->status === 'archived' ? 1 : 0,
        ];

        $inquiry->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
        ]);
    }
}
