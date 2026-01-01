<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Imports\EmailContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
    public function index()
    {
        // 1) Total Leads = all records
        $totalLeads = EmailContact::count();

        // 2) Potential Leads = company AND kirim are both filled (not null / not empty)
        $potentialLeads = EmailContact::whereNotNull('company')
            ->where('company', '!=', '')
            ->whereNotNull('kirim')
            ->where('kirim', '!=', '')
            ->count();

        // 3) Non-potential Leads = all leads minus potential ones
        $nonPotentialLeads = $totalLeads - $potentialLeads;

        // 4) Inactive Leads = status = 'inactive'
        $inactiveLeads = EmailContact::where('status', 'inactive')->count();

        return view('admin.leads', [
            'title'    => 'Leads',
            'totalLeads'        => $totalLeads,
            'potentialLeads'    => $potentialLeads,
            'nonPotentialLeads' => $nonPotentialLeads,
            'inactiveLeads'     => $inactiveLeads,
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

        return back()->with('success', 'Lead successfully added.');
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

    public function datatable()
    {
        $query = EmailContact::query();

        return DataTables::eloquent($query)
            ->addIndexColumn()

            ->addColumn('checkbox', function () {
                return '
            <div class="item-checkbox ms-1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox">
                    <label class="custom-control-label"></label>
                </div>
            </div>';
            })

            ->addColumn('company', function ($c) {
                return '
            <a href="javascript:void(0)" 
               class="hstack gap-5 btn-view-contact"
               data-bs-toggle="modal"
               data-bs-target="#viewContactModal"
               data-company="' . e($c->company) . '"
               data-main_product="' . e($c->main_product) . '"
               data-website="' . e($c->website) . '"
               data-kirim="' . e($c->kirim) . '"
               data-country="' . e($c->country) . '"
               data-phone="' . e($c->phone) . '"
               data-whatsapp="' . e($c->whatsapp) . '"
               data-contact_person="' . e($c->contact_person) . '"
               data-notes="' . e($c->notes) . '"
               data-status="' . e($c->status) . '">
                <span class="text-truncate-1-line">' . e($c->company) . '</span>
            </a>';
            })

            ->addColumn('email', fn($c) => trim($c->kirim) ?: '-')
            ->addColumn('contact_person', fn($c) => trim($c->contact_person) !== '' ? $c->contact_person : '-')
            ->addColumn('main_product', fn($c) => trim($c->main_product) !== '' ? $c->main_product : '-')

            ->addColumn('status', function ($c) {
                return $c->status === 'active'
                    ? '<div class="badge bg-soft-success text-success">Active</div>'
                    : '<div class="badge bg-soft-danger text-danger">Inactive</div>';
            })

            ->addColumn('action', function ($c) {
                return '
<div class="hstack gap-2 justify-content-end">

    <a href="javascript:void(0)"
        class="avatar-text avatar-md btn-view-contact"
        data-bs-toggle="modal"
        data-bs-target="#viewContactModal"
        data-company="' . e($c->company) . '"
        data-main_product="' . e($c->main_product) . '"
        data-website="' . e($c->website) . '"
        data-kirim="' . e($c->kirim) . '"
        data-country="' . e($c->country) . '"
        data-phone="' . e($c->phone) . '"
        data-whatsapp="' . e($c->whatsapp) . '"
        data-contact_person="' . e($c->contact_person) . '"
        data-notes="' . e($c->notes) . '"
        data-status="' . e($c->status) . '">
        <i class="feather feather-eye"></i>
    </a>

    <div class="dropdown">
        <a href="javascript:void(0)" class="avatar-text avatar-md"
            data-bs-toggle="dropdown" data-bs-offset="0,21">
            <i class="feather feather-more-horizontal"></i>
        </a>

        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item btn-edit-contact"
                   href="javascript:void(0)"
                   data-bs-toggle="modal"
                   data-bs-target="#editContactModal"
                   data-update-url="' . route('leads.update', $c->id) . '"
                   data-id="' . $c->id . '"
                   data-company="' . e($c->company) . '"
                   data-main_product="' . e($c->main_product) . '"
                   data-website="' . e($c->website) . '"
                   data-kirim="' . e($c->kirim) . '"
                   data-country="' . e($c->country) . '"
                   data-phone="' . e($c->phone) . '"
                   data-whatsapp="' . e($c->whatsapp) . '"
                   data-contact_person="' . e($c->contact_person) . '"
                   data-notes="' . e($c->notes) . '"
                   data-status="' . e($c->status) . '">
                    <i class="feather feather-edit-3 me-3"></i>
                    <span>Edit</span>
                </a>
            </li>

            <li>
                <form action="' . route('leads.destroy', $c->id) . '"
                      method="POST"
                      class="delete-contact-form m-0 p-0">
                    ' . csrf_field() . method_field('DELETE') . '
                    <a href="javascript:void(0)"
                       class="dropdown-item btn-delete-contact">
                        <i class="feather feather-trash-2 me-3"></i>
                        <span>Delete</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>';
            })


            ->filter(function ($query) {

                if (request()->has('search') && request('search')['value'] !== '') {

                    $search = request('search')['value'];

                    $query->where(function ($q) use ($search) {

                        $q->where('company', 'LIKE', "%{$search}%")
                            ->orWhere('kirim', 'LIKE', "%{$search}%")          // email
                            ->orWhere('country', 'LIKE', "%{$search}%")
                            ->orWhere('contact_person', 'LIKE', "%{$search}%")
                            ->orWhere('main_product', 'LIKE', "%{$search}%")
                            ->orWhere('website', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%")
                            ->orWhere('whatsapp', 'LIKE', "%{$search}%")
                            ->orWhere('notes', 'LIKE', "%{$search}%")
                            ->orWhere('status', 'LIKE', "%{$search}%");
                    });
                }
            })
            ->rawColumns(['checkbox', 'company', 'status', 'action'])
            ->make(true);
    }
}
