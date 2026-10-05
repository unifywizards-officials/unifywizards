<?php

namespace App\Http\Controllers;

use App\Models\AboutCTA;
use App\Models\AboutSection;
use App\Models\Client;
use App\Models\Industry;
use App\Models\Introduction;
use App\Models\Review;
use App\Models\WhyChoose;
use App\Models\HomeTestimonial;

class AboutUsController extends Controller
{
    public function index()
    {
        // Hero Section
        $hero = AboutSection::where('section_key', 'hero')
            ->where('status', 1)
            ->first();

        // Introduction Section
        $introductions = Introduction::where('status', 1)
            ->orderBy('sort_order')
            ->get();
           // dd($introductions);

        // Why Choose Us
        $whyChooses = WhyChoose::where('status', 1)
            ->orderBy('sort_order')
            ->get();

      

        // Clients
        $clients = Client::where('status', 1)
            ->orderBy('sort_order')
            ->get();
          

        // Industries
        $industries = Industry::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        // Platform Reviews
         $review = Review::getSingle();
      
       
       $gettestimonial = HomeTestimonial::first();


        // CTA
        $cta = AboutCTA::first();

       // dd($cta);

        return view('aboutus', compact(
            'hero',
            'introductions',
            'whyChooses',
            'clients',
            'industries',
            'review',
            'gettestimonial',
             'cta'
        ));
    }
}