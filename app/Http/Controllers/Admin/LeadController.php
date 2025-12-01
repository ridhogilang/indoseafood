<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    public function index()
    {
        return view('admin.leads', [
            'title' => 'Leads',
        ]);
    }
}
