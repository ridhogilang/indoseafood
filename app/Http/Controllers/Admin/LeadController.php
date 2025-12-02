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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'        => ['required', 'string', 'max:255'],        // cuma ini yang wajib
            'main_product'   => ['nullable', 'string', 'max:255'],
            'website'        => ['nullable', 'string', 'max:255'],
            'kirim'          => ['nullable', 'email', 'max:255'],        // email tapi tidak wajib
            'country'        => ['nullable', 'string', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:255'],
            'whatsapp'       => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'notes'          => ['nullable', 'string'],
            'main_product'   => ['nullable', 'string'],
            'status'         => ['required', 'in:active,inactive'],      // default di DB juga 'active'
        ]);

        if (!empty($validated['kirim'])) {
            $validated['kirim'] = strtolower(trim($validated['kirim']));
        }

        EmailContact::create($validated);

        return back()->with('success', 'Lead berhasil ditambahkan.');
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

    public function update(Request $request, EmailContact $email_contact)
    {
        $validated = $request->validate([
            'company'        => ['required', 'string', 'max:255'],
            'main_product'   => ['nullable', 'string'],
            'website'        => ['nullable', 'string', 'max:255'],
            'kirim'          => ['nullable', 'email', 'max:255'],
            'country'        => ['nullable', 'string', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:255'],
            'whatsapp'       => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'notes'          => ['nullable', 'string'],
            'status'         => ['required', 'in:active,inactive'],
        ]);

        // Normalisasi email ke huruf kecil
        if (!empty($validated['kirim'])) {
            $validated['kirim'] = strtolower(trim($validated['kirim']));
        }

        $email_contact->update($validated);

        return back()->with('success', 'Lead updated successfully.');
    }

    public function destroy(\App\Models\EmailContact $email_contact)
    {
        $email_contact->delete();

        return back()->with('success', 'Contact deleted successfully.');
    }
}
