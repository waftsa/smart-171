<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Documentation;
use App\Models\Donation;
use App\Models\Release;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data = Cache::remember('home_page', 600, function () {

        $articles = Article::where('status', true)
            ->latest()
            ->take(6)
            ->get();

        $releases = Release::where('status', true)
            ->latest()
            ->take(3)
            ->get();

        $donations = Donation::where('is_active', true)
            ->withSum('donaturs', 'total_amount') 
            ->latest()
            ->take(3) 
            ->get();

        $documentations = Documentation::where('status', true)
            ->where('category_id', 8)
            ->latest()
            ->take(4) 
            ->get();

        $sliders = collect();

        $sliders = $sliders->concat(
            Article::where('slider', true)
                ->where('status', true)
                ->select('id','title','slug','cover','summary')
                ->take(3)
                ->get()
                ->map(fn($item) => tap($item)->setAttribute('type','smartnews'))
        );

        $sliders = $sliders->concat(
            Donation::where('slider', true)
                ->where('is_active', true)
                ->select('id','name','slug','thumbnail','about')
                ->take(3)
                ->get()
                ->map(fn($item) => tap($item)->setAttribute('type','smartcampaign'))
        );

        return compact(
            'articles',
            'releases',
            'donations',
            'documentations',
            'sliders'
        );
    });

    return view('home', $data);
    }

    public function about()
    {
        $articles = Article::where('status', true)->latest()->take(6)->get();
        $donations = Donation::where('is_active', true)->latest()->take(6)->get(); 
        $documentations = Documentation::where('status', true)->latest()->take(5)->get(); 
        
        return view('about-us.about', compact('articles', 'donations', 'documentations'));
    }

    public function ota(){
        return view('ota.index');
    }

    public function paketUmum(){
        return view('ota.umum');
    }

    public function paketPatungan(){
        return view('ota.patungan');
    }

    public function paketPatungan2(){
        return view('ota.patungan2');
    }


}
