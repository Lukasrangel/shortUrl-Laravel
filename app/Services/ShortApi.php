<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class ShortApi {

    
    public static function getDomainId() {

        $domains = Http::shortapi()->get('/api/domains')->json();

        foreach($domains as $domain){
            if($domain['hostname'] == config("constants.API_DOMAIN")) {
                return $domain['id'];
            }
        } 
        return False;
    }


    public static function getLinks() {

        $links = Http::shortapi()->get('/api/links',[
            "domain_id" => self::getDomainId(),
            'limit'     => 30,
            'dateSortOrder' => 'desc'
        ])->json();

        
        return $links;

    }


    public static function getClicks($linkId) {

        $clicks = Http::shortapi()->get('https://statistics.short.io/statistics/link/'.$linkId.'?period=last30&tz=UTC')
        ->json()['humanClicks'];

        return $clicks;
    }


    public static function delete($id) {

        $delete = Http::shortapi()->delete("/links/".$id)->json();

        return $delete['success'];
        
    }

    public static function createLink($link) {

        $domain = config('constants.API_DOMAIN');

        $post = Http::shortapi()->post('/links',[
            'domain' => $domain,
            'originalURL' => $link
        ]);

        return $post;

    }

}

?>