<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;
use DOMDocument;
use DOMXPath;


class ReversoHelper
{
    public static function getSpellCheck($text) {
        $url    = 'https://orthographe.reverso.net/api/v1/Spelling';

        $data   = [
                    'language' => 'eng',
                    'getCorrectionDetails' => true,
                    'origin' => 'interactive',
                    'text' => strtolower($text)
                    ];

        $response = Http::post($url, $data);

        return $response;
    }

    public static function getConjugation($verb) {
        $url    = 'https://conjugator.reverso.net/conjugation-english-verb-'.ReversoHelper::encodeURIComponent($verb).'.html';

        $content = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($content);
        $finder = new DOMXPath($dom);
        $classname="blue-box-wrap";
        $nodes = $finder->query("//*[contains(@class, '$classname')]");

        $verbData           = array();
        foreach($nodes as $node_index => $node) {
            $data           = array();
            $data['title']  = $node->getAttribute('mobile-title');
            $data['words']  = [];
            foreach($node->childNodes as $childNode) {
                if ($childNode->tagName == 'ul') {
                    
                    foreach($childNode->childNodes as $li) {
                        $data['words'][] = $li->textContent;
                    }
                }
            }
            $verbData[] = $data;
        }

        return $verbData;
    }

    public static function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
}
