<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function services()
    {
        return view('pages.services');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function refundPolicy()
    {
        return view('pages.refund-policy');
    }

    public function faq()
    {
        return view('pages.faq');
    }
}
