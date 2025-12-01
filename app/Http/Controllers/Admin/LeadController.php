<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Imports\EmailContactsImport;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index()
    {
        $contacts = EmailContact::orderBy('id', 'asc')->get();

        return view('admin.leads', [
            'title'    => 'Leads',
            'contacts' => $contacts,
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xls,xlsx', 'max:5120'],
        ]);

        $import = new EmailContactsImport();

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Throwable $e) {
            Log::error('Import Email Contacts Error: ' . $e->getMessage());

            return back()->with('error', 'Gagal mengimport data. Pastikan format Excel sudah benar.');
        }

        $duplicates = $import->getDuplicates();

        $successMessage = 'Kontak email berhasil diimport!';
        if (!empty($duplicates)) {
            $successMessage .= ' ' . count($duplicates) . ' kontak duplikat tidak ditambahkan.';
        }

        return back()->with([
            'success'    => $successMessage,
            'duplicates' => $duplicates,  // bisa dipakai di SweetAlert
        ]);
    }
}
