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
        
        return view('admin.inquiry.list', [
            'title' => 'Inquiry List',
            'inquiries' => $inquiries,
        ]);
    }
}
