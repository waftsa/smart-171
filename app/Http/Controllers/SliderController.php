<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Documentation;
use App\Models\Donation;
use App\Models\Release;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function index(){
        $sliders = Article::where('slider', true)->get()->map(function ($item) {
            $item->type = 'smartnews';
            return $item;
        })->concat(
            Donation::where('slider', true)->get()->map(function ($item) {
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
        
        return view('admin.sliders.index', compact('sliders'));
    }

    public function destroy($type, $id)
    {
        $model = match ($type) {
            'articles' => Article::class,
            'donations' => Donation::class,
            'documentations' => Documentation::class,
            'releases' => Release::class,
            default => null,
        };
    
        if ($model) {
            $item = $model::findOrFail($id);
            $item->update(['slider' => false]); // Ubah slider jadi false
            return redirect()->route('admin.sliders.index')->with('success', 'Data berhasil dihapus dari slider.');
        }
    
        return redirect()->route('admin.sliders.index')->with('error', 'Tipe data tidak valid.');
    }
}

