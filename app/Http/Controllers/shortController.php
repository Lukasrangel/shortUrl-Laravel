<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShortApi;

class shortController extends Controller
{
    public static function index() {

        $links = ShortApi::getLinks()['links'];

        $clicks = [];
        foreach($links as $link){
            $clicks[$link['id']] = ShortApi::getClicks($link['id']);
        }
        
        
        return view('createLink',['links' => $links, 'clicks' => $clicks]);
    }


    public static function delete($id) {

        $delete = ShortApi::delete($id);

        if($delete){
            return redirect('/links')->with('msg', 'Link Excluído com sucesso!');
        } else {
            return redirect('/links')->with('msg', 'Erro');
        }
    }

    public static function createLink(Request $request) {

        $post = ShortApi::createLink($request->link);

        var_dump($post->status());
        if($post->status() == 200){
            return redirect('/links')->with('msg','Short Link Gerado com sucesso!');
        } else {
            return redirect('/links')->with('msg','URL inválida');
        }
    }
}
