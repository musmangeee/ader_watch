<?php

namespace App\Http\Controllers\Helper;

use App\Business;
use App\BusinessCategory;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Town;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HelperController extends Controller
{

    public function array_flatten($array)
    {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function getClientIps()
    {
        $clientIps = array();
        $ip = $this->server->get('REMOTE_ADDR');
        if (!$this->isFromTrustedProxy()) {
            return array($ip);
        }
        if (self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED])) {
            $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
            preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
            $clientIps = $matches[3];
        } elseif (self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP])) {
            $clientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));
        }
        $clientIps[] = $ip; // Complete the IP chain with the IP the request actually came from
        $ip = $clientIps[0]; // Fallback to this when the client IP falls into the range of trusted proxies
        foreach ($clientIps as $key => $clientIp) {
            // Remove port (unfortunately, it does happen)
            if (preg_match('{((?:\d+\.){3}\d+)\:\d+}', $clientIp, $match)) {
                $clientIps[$key] = $clientIp = $match[1];
            }
            if (IpUtils::checkIp($clientIp, self::$trustedProxies)) {
                unset($clientIps[$key]);
            }
        }
        // Now the IP chain contains only untrusted proxies and the client IP
        return $clientIps ? array_reverse($clientIps) : array($ip);
    }

    public function set_category_preferences($search_category)
    {
        $categories = array_slice(Category::all('name')->toArray(), 0, 4);
        $categories = array_column($categories, 'name');

        $search_preferences = Cookie::get('searchPrefs');


        if ($search_preferences == null) {

            Cookie::queue(Cookie::make('searchPrefs', serialize($categories), 645000));

            // The user is visiting the first time
            return $categories;

        } else {
            $search_preferences = unserialize($search_preferences);
            $search_preferences_old = $search_preferences;
            if (($key = array_search($search_category, $search_preferences)) !== false) {
                unset($search_preferences[$key]);
            }
            if ($key != 0)
                [$search_preferences_old[$key - 1], $search_preferences_old[$key]] = [$search_preferences_old[$key], $search_preferences_old[$key - 1]];

            Cookie::queue(Cookie::make('searchPrefs', serialize($search_preferences_old), 645000));
        }

        return $search_preferences_old;
    }


    public function get_category_preferences()
    {
        $categories = array_slice(Category::all('name')->toArray(), 0, 4);
        return array_column($categories, 'name');

    }

    public function get_prefer_wallpaper()
    {

        if(isset($this->get_category_preferences()[0])){

        if ($this->get_category_preferences()[0] == 'Restaurants')
            $default_walpaper = 'restaurants.png';
        elseif ($this->get_category_preferences()[0] == 'Night Life')
            $default_walpaper = 'night-life.jpg';
        elseif ($this->get_category_preferences()[0] == 'Beauty & Spa')
            $default_walpaper = 'beauty.png';
        elseif ($this->get_category_preferences()[0] == 'Food')
            $default_walpaper = 'banner-new.jpg';
        else
            $default_walpaper = 'banner-new.jpg';
        }else{
            $default_walpaper = 'banner-new.jpg';
        }
        return $default_walpaper;

    }


    public function main_menu_data($searched_location = null, $search_category = '', $searched_keyword = '')
    {
        $pref_categories = $this->get_category_preferences();

        $reward = 0;
        if(Auth::check())
        {
            $reward = View::where('user_id', Auth::user()->id)->sum('reward');
        }
        return [
            'reward' => $reward,
            'pref_categories' => $pref_categories,
        ];

    }



    public function get_find($find)
    {
        if ($find == null) {
            $result['status'] = true;
            $result['type'] = 'top_business_search';
        } elseif ($find != null) {
            $business = Business::where('name', $find)->first();
            $category = Category::where('name', $find)->first();
            if ($category != null) {
                $result['status'] = true;
                $result['type'] = 'category_search';
                $result['category'] = $category;
            } elseif ($business != null) {
                $result['status'] = true;
                $result['type'] = 'business_search';
                $result['business'] = $business;
            } else {
                $result['status'] = true;
                $result['type'] = 'keywords_search';
            }
        }
        $result['keywords'] = $find;
        return $result;
    }




}
