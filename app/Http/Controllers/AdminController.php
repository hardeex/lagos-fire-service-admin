<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function otpVerify()
    {
        return view('admin.otp');
    }


    public function main()
    {
        return view('admin.main');
    }

    public function manageUsers()
    {
        return view('admin.manage_user');
    }

    public function manageIndustry()
    {
        return view('admin.manage_industry');
    }

    public function manageBusiness()
    {
        return view('admin.manage_business');
    }

    public function invoice()
    {
        return view('admin.invoice');
    }

    public function accountHistory()
    {
        return view('admin.account_history');
    }

    public function uploadDocument()
    {
        return view('admin.upload_document');
    }


    public function fieldForm()
    {
        return view('admin.field-form');
    }
}
