<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

function responseJson($status, $message, $data=null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json($response);
}


if (!function_exists('up')) {
    function up() {
        return new \App\Http\Controllers\Upload;
    }
}
if (! function_exists('uploadImage')) {
    /**
     * @param $image \Illuminate\Http\UploadedFile|array
     * @param string $path
     * @param null $old
     * @return string|array
     */
    function uploadImage($image, $path = 'uploads',$old = null)
    {
        if ($old){
            Storage::has($old) ? Storage::delete($old) : '';
        }

        if (is_array($image)) {
            $images = [];
            foreach ($image as $item) {
                $images[] = $item->store('uploads');
            }

            return $images;
        }

        return $image->store('uploads');
    }
}


function settings()
{
    $settings = Setting::find(1);
    if ($settings) {
        return $settings;
    } else {
        return new Setting;
    }
}


if (!function_exists('active_menu')) {
    function active_menu($link) {
        if (preg_match('/'.$link.'/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}


if (!function_exists('lang')) {
    function lang() {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            return 'en';
        }
    }
}


if (!function_exists('direction')) {
    function direction() {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}




function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{
// https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
// API access key from Google FCM App Console
    // env('FCM_API_ACCESS_KEY'));

//    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
//    $registrationIDs = array(
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
//    );
    $registrationIDs = $tokens;

// prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support​
// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)

// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
//    dd(env('FIREBASE_API_ACCESS_KEY'));
    $headers = array(
        'Authorization: key=AAAAWGc2I-s:APA91bGb7kOaLQreX0g5mVR_Qz18ZRcKuCLHkjS5lGJdsUgA6BuBagfxbhBkp-d-lf2J8Zy8WN9aoewEHTFi9povT6tUrSc2atBrGCqDhqObT4uNOqRu566FCqaDGdIo_Nd8zVh1jhQU',
        'Content-Type: application/json'
    );
    // if($type == 'client')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_client'),
    //         'Content-Type: application/json'
    //     );
    // }
    // if($type == 'driver')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_driver'),
    //         'Content-Type: application/json'
    //     );
    // }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function distanceBTP($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        $dist = ($miles * 1.609344);
        $dist=$dist < 1?1:$dist;
        return $dist;
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }

}



if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return 	['sProcessing' => trans('datatable.sProcessing'),
            'sLengthMenu' => trans('datatable.sLengthMenu'),
            'sZeroRecords' => trans('datatable.sZeroRecords'),
            'sEmptyTable' => trans('datatable.sEmptyTable'),
            'sInfo' => trans('datatable.sInfo'),
            'sInfoEmpty' => trans('datatable.sInfoEmpty'),
            'sInfoFiltered' => trans('datatable.sInfoFiltered'),
            'sInfoPostFix' => '',
            'sSearch' => trans('datatable.sSearch'),
            'sUrl' => '',
            'sInfoThousands' => trans('datatable.sInfoThousands'),
            'sLoadingRecords' => trans('datatable.sLoadingRecords'),
            'oPaginate' =>  [
                'sFirst'=> trans('datatable.sFirst'),
                'sLast'=> trans('datatable.sLast'),
                'sNext'=> trans('datatable.sNext'),
                'sPrevious'=> trans('datatable.sPrevious')
            ],
            'oAria' => [
                'sSortAscending'=> trans('datatable.sSortAscending'),
                'sSortDescending'=> trans('datatable.sSortDescending')
            ],
        ];
    }
}
