<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Documentation;
use App\Models\Donation;
use App\Models\Release;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $articles = Article::where('status', true)->latest()->take(6)->get();
        $releases = Release::where('status', true)->latest()->take(3)->get();
        $donations = Donation::where('is_active', true)->latest()->take(6)->get(); 
        $documentations = Documentation::where('status', true)->where('category_id', 8)->latest()->get(); 

       $sliders = Article::where([['slider', true],['status', true]])->get()->map(function ($item) {
            $item->type = 'smartnews';
            return $item;
        })->concat(
            Donation::where([['slider', true],['is_active', true]])->get()->map(function ($item) {
                $item->type = 'smartcampaign';
                return $item;
            })
        )->concat(
            Documentation::where([['slider', true],['status', true]])->get()->map(function ($item) {
                $item->type = 'documentations';
                return $item;
            })
        )->concat(
            Release::where([['slider', true],['status', true]])->get()->map(function ($item) {
                $item->type = 'smartreleases';
                return $item;
            })
        );
        
        return view('home', compact('articles', 'donations', 'documentations', 'releases', 'sliders'));
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
