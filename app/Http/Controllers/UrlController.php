<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use App\Models\Url;
use App\Helpers\Tokenizer;

class UrlController extends Controller
{
    const BASE_URL = "www.github.com/samuraya";
    const DEFAULT_LEN = 6;

    public function index()
    {
        //calling Laravel macro and passing component name
        return View::component('CreateUrl');      
    }

    public function url(Request $request)
    {
    	$this->validate($request, [
            'url'   => 'required|min:3',            
        ]);

        $url = Url::where('long',$request->url)->first();

        //generate short url when long url not in DB
    	if($url == null) {
    		$shortUrl = $this->generateShortUrl();
    		$newURL = Url::create([
    			'long'=>$request->url,
    			'short'=>$shortUrl
    		]);
    		$url = $newURL;    		
    	}

        return response()->json([
            'url' => self::BASE_URL.'/'.$url->short           
        ]);

    }

    public function generateShortUrl($length = self::DEFAULT_LEN)
    {
    	do {
            $token = Tokenizer::randomCollection($length);
        } while(Url::where('short',$token)->first() != null );

        return $token;
    }
}
