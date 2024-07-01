<?php

namespace App\Http\Middleware;

use App\Jobs\addVisitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VisitorCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Cookie::has('uuid-client')){
            $payload['uid'] = Cookie::get('uuid-client');
        }else{
            $payload['uid'] = Str::uuid()->toString();
        }

        // check if route is single post
        // $ip_user_info = Cache::remember('ip-data-' . $payload['uid'], env('CACHE_DURATION'), function () {
        //     $ipdata = Http::get('http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR']);
        //     if($ipdata->json('status') == 'success'){
        //         return $ipdata->json();
        //     }else{
        //         return ['country' => '', 'regionName' => '', 'city' => ''];
        //     }
        // });

            $payload['country'] = ''; //$ip_user_info['country'];
            $payload['region'] = ''; //$ip_user_info['regionName'];
            $payload['city'] = ''; //$ip_user_info['city'];


        // dd(Cookie::get('uuid-client'));
        $payload['ip'] = $_SERVER['REMOTE_ADDR'];
        $payload['os'] = $this->get_client_os();
        $payload['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $payload['browser'] = $this->get_client_browser();
        $payload['post_id'] = $request->route()->parameter("post_id");//currently not available
        $payload['url'] = $_SERVER['REQUEST_URI'];
        $payload['referer'] = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        // make job add visitor
        
        // check if it's bot user agent
        if(!$this->is_bot($payload['user_agent']) && !$this->is_illegal_referer($payload['referer'])){
            addVisitor::dispatch($payload)->onQueue('database');
        }


        if(Cookie::has('uuid-client')){
            return $next($request);
            
        }else{
            return $next($request)->withCookie(cookie('uuid-client', $payload['uid'], 60 * 24 * 30));
        }
    }

    private function get_client_os() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";
    
        $os_array = array(
            '/windows nt 11/i'      =>  'Windows 11',
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
    
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }   
        return $os_platform;
    }

    private function get_client_browser() {
        $browser = '';
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) $browser = 'Netscape';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) $browser = 'Firefox';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) $browser = 'Chrome';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) $browser = 'Opera';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) $browser = 'Internet Explorer';
        else $browser = 'Other';
        return $browser;
    }

    private function is_bot($userAgent) {
        $botList = file_get_contents('../'.config('BASE_PATH').'/crawler-user-agents.json');
        $botList = json_decode($botList, true);
        $has_bot = array();
        foreach ($botList as $bot) {
            if (preg_match('/'.$bot['pattern'].'/', $userAgent) == true) {
                $has_bot[] = $bot;
            }
        }
        if (count($has_bot) > 0) {
            return true;
        } else { 
            return false;
        }
    }
    private function is_illegal_referer($referer) {
        $blacklist = file_get_contents('../'.config('BASE_PATH').'/blacklist-referer.json');
        $blacklist = json_decode($blacklist, true);
        $has_blacklist = array();
        foreach ($blacklist as $data) {
            if (preg_match('/'.$data['pattern'].'/', $referer) == true) {
                $has_blacklist[] = $data;
            }
        }
        if (count($has_blacklist) > 0) {
            return true;
        } else { 
            return false;
        }
    }
}
