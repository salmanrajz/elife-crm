<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class AnnotationController extends Controller
{
    //
    public function displayForm()
    {
        return view('dashboard.annotate');
    }

    public function annotateImage(Request $request)
    {
        if ($request->file('image')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('image')));
            //prepare request
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  env('GOOGLE_CLOUD_KEY'));
            //send annotation request
            $response = $gcvRequest->annotate();
            //  $string =  json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
            // ech
            $string = $response->responses[0]->textAnnotations[0]->description;
            $string = preg_replace('/\s+/', ' ', $string) . '<br>';
            $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
            $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
            $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';

            foreach (explode(' ', $string) as $id) {
                // echo $id . '<br>';
                // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
                // print_r($matches);
                // }
                preg_match($regex2, $id, $matches2);

                // if match, show VALID
                if (count($matches2) == 1) {
                    echo '###' . $id;
                } else {
                    // echo "{$id} INVALID</br>";
                }
            }
            // echo $string['description'];
            if (preg_match('/Name:(.*?)Nation/', $string, $match) == 1) {
                echo '###' . $match[1] . '<br>';
            }
            foreach (explode(' ', $string) as $id) {
                // echo $id . '<br>';
                preg_match($regex, $id, $matches);

                // // if match, show VALID
                if (count($matches) == 1) {
                    // echo "SSS";
                    // echo $matches['0'];
                    echo '###' . "{$id}";
                }
                // else {
                //     // echo "{$string} INVALID</br>";
                // }
            }
        }
    }
}
