<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Storage;
class Utility extends Model
{
    public static function AddBusinessField(){

        $data = [
            ['name' => 'phone','icon' => 'fa fa-phone'],
            ['name' => 'email','icon' => 'fa fa-envelope'],
            ['name' => 'address','icon' => 'fa fa-map-marker'],
            ['name' => 'website','icon' => 'fa fa-link'],
            ['name' => 'custom_field','icon' => 'fa fa-align-left'],
            ['name' => 'facebook','icon' => 'fab fa-facebook'],
            ['name' => 'twitter','icon' => 'fab fa-twitter'],
            ['name' => 'instagram','icon' => 'fab fa-instagram'],
            ['name' => 'whatsapp','icon' => 'fab fa-whatsapp'],
        ];
        foreach($data as $value){
            \DB::insert(
                'insert into businessfields (`name`,`icon`,`created_at`,`updated_at`) values (?,?,?,?) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`) ', [$value['name'],$value['icon'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]
            );
        }

        return true;
    }

    public static function createSlug($table, $title, $id = 0)
    {

        // Normalize the title
        $slug = Str::slug($title, '-');
        $routes = array_map(function (\Illuminate\Routing\Route $route){return $route->uri;}, (array) Route::getRoutes()->getIterator());


        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = self::getRelatedSlugs($table, $slug, $id);
        // If we haven't used it before then we are all good.
        if(!$allSlugs->contains('slug', $slug) && !in_array($slug,$routes))
        {

            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for($i = 1; $i <= 100; $i++)
        {
            $newSlug = $slug . '-' . $i;
            if(!$allSlugs->contains('slug', $newSlug) && !in_array($newSlug,$routes))
            {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public static function getRelatedSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->select()->where('slug', 'like', $slug . '%')->where('id', '<>', $id)->get();
    }

    public static function getFields()
    {
        $icons = [
            'Facebook','Instagram','LinkedIn','Phone','Twitter','Youtube','Email','Behance','Dribbble','Figma','Messenger',
            'Pinterest','Tiktok'
        ];

        return $icons;
    }

    public static function themeOne()
    {
        $arr = [];

        $arr = [
            'theme1' => [
                'color1-theme1' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme1/color1.png')),
                    'color' => '#FDD395',
                ],
                'color2-theme1' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme1/color2.png')),
                    'color' => '#94D2BD',
                ],
                'color3-theme1' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme1/color3.png')),
                    'color' => '#168AAD',
                ],
                'color4-theme1' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme1/color4.png')),
                    'color' => '#A01A58',
                ],
                'color5-theme1' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme1/color5.png')),
                    'color' => '#B5E48C',
                ],
            ],
            'theme2' => [
                'color1-theme2' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme2/color1.png')),
                    'color' => 'linear-gradient(180deg, #ADE8F4 0%, #46B7CE 100%)',
                ],
                'color2-theme2' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme2/color2.png')),
                    'color' => 'linear-gradient(180deg, #D9ED92 0%, #B5E48C 100%)',
                ],
                'color3-theme2' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme2/color3.png')),
                    'color' => 'linear-gradient(180deg, #F7B801 0%, #F18701 100%)',
                ],
                'color4-theme2' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme2/color4.png')),
                    'color' => 'linear-gradient(180deg, #94D2BD 0%, #0A9396 100%)',
                ],
                'color5-theme2' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme2/color5.png')),
                    'color' => 'linear-gradient(180deg, #FF7900 0%, #FF5400 100%)',
                ],
            ],

            'theme3' => [
                'color1-theme3' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme3/color1.png')),
                    'color' => '#99E2B4',
                ],
                'color2-theme3' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme3/color2.png')),
                    'color' => '#F18701',
                ],
                'color3-theme3' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme3/color3.png')),
                    'color' => '#34A0A4',
                ],
                'color4-theme3' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme3/color4.png')),
                    'color' => '#7678ED',
                ],
                'color5-theme3' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme3/color5.png')),
                    'color' => '#4EAAFF',
                ],
            ],
            'theme4' => [
                'color1-theme4' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme4/color1.png')),
                    'color' => '#000000',
                ],
                'color2-theme4' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme4/color2.png')),
                    'color' => '#858585;
                    ',
                ],
                'color3-theme4' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme4/color3.png')),
                    'color' => '#005F73',
                ],
                'color4-theme4' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme4/color4.png')),
                    'color' => '#723C70',
                ],
                'color5-theme4' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme4/color5.png')),
                    'color' => '#60873A',
                ],
            ],
            'theme5' => [
                'color1-theme5' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme5/color1.png')),
                    'color' => '#F05C35',
                ],
                'color2-theme5' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme5/color2.png')),
                    'color' => '#0A9396',
                ],
                'color3-theme5' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme5/color3.png')),
                    'color' => '#B5E48C',
                ],
                'color4-theme5' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme5/color4.png')),
                    'color' => '#B7094C',
                ],
                'color5-theme5' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme5/color5.png')),
                    'color' => '#7678ED',
                ],
            ],
            'theme6' => [
                'color1-theme6' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme6/color1.png')),
                    'color' => '#52189C',
                ],
                'color2-theme6' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme6/color2.png')),
                    'color' => '#FF9E00',
                ],
                'color3-theme6' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme6/color3.png')),
                    'color' => '#CB997E',
                ],
                'color4-theme6' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme6/color4.png')),
                    'color' => '#6B705C',
                ],
                'color5-theme6' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme6/color5.png')),
                    'color' => '#76C893',
                ],
            ],
            'theme7' => [
                'color1-theme7' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme7/color1.png')),
                    'color' => '#000000',
                ],
                'color2-theme7' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme7/color2.png')),
                    'color' => '#455E89',
                ],
                'color3-theme7' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme7/color3.png')),
                    'color' => '#3D348B',
                ],
                'color4-theme7' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme7/color4.png')),
                    'color' => '#9B2226',
                ],
                'color5-theme7' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme7/color5.png')),
                    'color' => '#52B69A',
                ],
            ],
            'theme8' => [
                'color1-theme8' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme8/color1.png')),
                    'color' => 'linear-gradient(102.24deg, #936639 6.21%, #656D4A 99.29%)',
                ],
                'color2-theme8' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme8/color2.png')),
                    'color' => 'linear-gradient(102.24deg, #723C70 6.21%, #2E6F95 99.29%)',
                ],
                'color3-theme8' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme8/color3.png')),
                    'color' => 'linear-gradient(102.24deg, #005F73 6.21%, #0A9396 99.29%)',
                ],
                'color4-theme8' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme8/color4.png')),
                    'color' => 'linear-gradient(102.24deg, #9B2226 6.21%, #BB3E03 99.29%)',
                ],
                'color5-theme8' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme8/color5.png')),
                    'color' => 'linear-gradient(102.24deg, #76C893 6.21%, #99D98C 99.29%)',
                ],
            ],
            'theme9' => [
                'color1-theme9' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme9/color1.png')),
                    'color' => '#FFD4E0',
                ],
                'color2-theme9' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme9/color2.png')),
                    'color' => '#FFE8D6',
                ],
                'color3-theme9' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme9/color3.png')),
                    'color' => '#B7B7A4',
                ],
                'color4-theme9' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme9/color4.png')),
                    'color' => '#B5E48C',
                ],
                'color5-theme9' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme9/color5.png')),
                    'color' => '#94D2BD',
                ],
            ],
            'theme10' => [
                'color1-theme10' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme10/color1.png')),
                    'color' => '#F7762E',
                ],
                'color2-theme10' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme10/color2.png')),
                    'color' => '#7678ED',
                ],
                'color3-theme10' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme10/color3.png')),
                    'color' => '#99D98C',
                ],
                'color4-theme10' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme10/color4.png')),
                    'color' => '#1A759F',
                ],
                'color5-theme10' => [
                    'img_path' => asset(Storage::url('uploads/card_theme/theme10/color5.png')),
                    'color' => '#6B705C',
                ],
            ],

        ];

        return $arr;
    }
    public static function getCompanyPaymentSetting()
    {

        $data     = \DB::table('company_payment_settings');
        $settings = [];
        if(\Auth::check())
        {
            $user_id = \Auth::user()->creatorId();
            $data    = $data->where('created_by', '=', $user_id);

        }
        $data = $data->get();
        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }
    public static function settings()
    {
        $data = DB::table('settings');
        if(\Auth::check())
        {
            $userId = \Auth::user()->creatorId();
            $data   = $data->where('created_by', '=', $userId);
        }
        else
        {
            $data = $data->where('created_by', '=', 1);
        }
        $data     = $data->get();
        $settings = [
            "site_currency" => "USD",
            "site_currency_symbol" => "$",
            "site_currency_symbol_position" => "pre",
            "site_date_format" => "M j, Y",
            "site_time_format" => "g:i A",
            "company_name" => "",
            "company_address" => "",
            "company_city" => "",
            "company_state" => "",
            "company_zipcode" => "",
            "company_country" => "",
            "company_telephone" => "",
            "company_email" => "",
            "company_email_from_name" => "",
            "invoice_prefix" => "#INVO",
            "invoice_color" => "ffffff",
            "proposal_prefix" => "#PROP",
            "proposal_color" => "ffffff",
            "bill_prefix" => "#BILL",
            "bill_color" => "ffffff",
            "customer_prefix" => "#CUST",
            "vender_prefix" => "#VEND",
            "footer_title" => "",
            "footer_notes" => "",
            "invoice_template" => "template1",
            "bill_template" => "template1",
            "proposal_template" => "template1",
            "registration_number" => "",
            "vat_number" => "",
            "default_language" => "en",
            "enable_stripe" => "",
            "enable_paypal" => "",
            "paypal_mode" => "",
            "paypal_client_id" => "",
            "paypal_secret_key" => "",
            "stripe_key" => "",
            "stripe_secret" => "",
            "decimal_number" => "2",
            "tax_type" => "",
            "shipping_display" => "on",
            "journal_prefix" => "#JUR",
            "display_landing_page" => "on",
            "title_text" => "",
            "logo"=>'logo.png',
            "favicon"=>'favicon.png'
        ];

        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    public static function getValByName($key)
    {
        $setting = Utility::settings();
        if(!isset($setting[$key]) || empty($setting[$key]))
        {
            $setting[$key] = '';
        }

        return $setting[$key];
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if(!file_put_contents($envFile, $str))
        {
            return false;
        }

        return true;
    }
    public static function add_landing_page_data()
    {
        $section_data   = [];
        $section_data[] = [
            'section_name' => 'section-1',
            'section_order' => 1,
            'default_content' => '{"logo":"landing_logo.png","image":"top-banner.png","button":{"text":"Login"},"menu":[{"menu":"Features","href":"#"},{"menu":"Pricing","href":"#"}],"text":{"text-1":"vCardGo SaaS","text-2":"Digital Business Card Builder","text-3":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.","text-4":"get started - its free","text-5":"no creadit card reqired "},"custom_class_name":""}',
            'content' => '{"logo":"landing_logo.png","image":"top-banner.png","button":{"text":"Login"},"menu":[{"menu":"Features","href":"#"},{"menu":"Pricing","href":"#"}],"text":{"text-1":"vCardGo SaaS","text-2":"Digital Business Card Builder","text-3":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.","text-4":"get started - its free","text-5":"no creadit card reqired"},"custom_class_name":""}',
            'section_demo_image' => 'top-header-section.png',
            'section_blade_file_name' => 'custome-top-header-section',
            'section_type' => 'section-1',
        ];
        $section_data[] = [
            'section_name' => 'section-2',
            'section_order' => 2,
            'default_content' => '{"image":"cal-sec.png","button":{"text":"try our system","href":"#"},"text":{"text-1":"Features","text-2":"Lorem Ipsum is simply dummy","text-3":"text of the printing","text-4":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"image_array":[{"id":1,"image":"nexo.png"},{"id":2,"image":"edge.png"},{"id":3,"image":"atomic.png"},{"id":4,"image":"brd.png"},{"id":5,"image":"trust.png"},{"id":6,"image":"keep-key.png"},{"id":7,"image":"atomic.png"},{"id":8,"image":"edge.png"}],"custom_class_name":""}',
            'content' => '{"image":"cal-sec.png","button":{"text":"try our system","href":"#"},"text":{"text-1":"Features","text-2":"Lorem Ipsum is simply dummy","text-3":"text of the printing","text-4":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"image_array":[{"id":1,"image":"nexo.png"},{"id":2,"image":"edge.png"},{"id":3,"image":"atomic.png"},{"id":4,"image":"brd.png"},{"id":5,"image":"trust.png"},{"id":6,"image":"keep-key.png"},{"id":7,"image":"atomic.png"},{"id":8,"image":"edge.png"}],"custom_class_name":""}',
            'section_demo_image' => 'logo-part-main-back-part.png',
            'section_blade_file_name' => 'custome-logo-part-main-back-part',
            'section_type' => 'section-2',
        ];
        $section_data[] = [
            'section_name' => 'section-3',
            'section_order' => 3,
            'default_content' => '{"image": "sec-2.png","button": {"text": "try our system","href": "#"},"text": {"text-1": "Features","text-2": "Lorem Ipsum is simply dummy","text-3": "text of the printing","text-4": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"custom_class_name":""}',
            'section_demo_image' => 'simple-sec-even.png',
            'section_blade_file_name' => 'custome-simple-sec-even',
            'section_type' => 'section-3',
        ];
        $section_data[] = [
            'section_name' => 'section-4',
            'section_order' => 4,
            'default_content' => '{"image": "sec-3.png","button": {"text": "try our system","href": "#"},"text": {"text-1": "Features","text-2": "Lorem Ipsum is simply dummy","text-3": "text of the printing","text-4": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"custom_class_name":""}',
            'section_demo_image' => 'simple-sec-odd.png',
            'section_blade_file_name' => 'custome-simple-sec-odd',
            'section_type' => 'section-4',
        ];
        $section_data[] = [
            'section_name' => 'section-5',
            'section_order' => 5,
            'default_content' => '{"button": {"text": "TRY OUR SYSTEM","href": "#"},"text": {"text-1": "See more features","text-2": "All Features","text-3": "in one place","text-4": "Attractive Dashboard Customer & Vendor Login Multi Languages","text-5":"Invoice, Billing & Transaction Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting","text-6":"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting","text-7":"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting User Friendly Invoice Theme Make your own setting","text-8":"Multi User & Permission Paypal & Stripe for Invoice"},"custom_class_name":""}',
            'section_demo_image' => 'features-inner-part.png',
            'section_blade_file_name' => 'custome-features-inner-part',
            'section_type' => 'section-5',
        ];
        $section_data[] = [
            'section_name' => 'section-6',
            'section_order' => 6,
            'default_content' => '{"system":[{"id":1,"name":"Dashboard","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":5,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":2,"name":"Functions","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"}]},{"id":3,"name":"Reports","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":4,"name":"Tables","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]},{"id":5,"name":"Settings","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":6,"name":"Contact","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]}],"custom_class_name":""}',
            'content' => '{"system":[{"id":1,"name":"Dashboard","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":5,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":2,"name":"Functions","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"}]},{"id":3,"name":"Reports","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":4,"name":"Tables","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]},{"id":5,"name":"Settings","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":6,"name":"Contact","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]}],"custom_class_name":""}',
            'section_demo_image' => 'container-our-system-div.png',
            'section_blade_file_name' => 'custome-container-our-system-div',
            'section_type' => 'section-6',
        ];
        $section_data[] = [
            'section_name' => 'section-7',
            'section_order' => 7,
            'default_content' => '{"testimonials":[{"id":1,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":2,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":3,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":4,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":5,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"}],"custom_class_name":""}',
            'section_demo_image' => 'testimonials-section.png',
            'section_blade_file_name' => 'custome-testimonials-section',
            'section_type' => 'section-7',
        ];
        $section_data[] = [
            'section_name' => 'section-plan',
            'section_order' => 8,
            'default_content' => 'plan',
            'content' => 'plan',
            'section_demo_image' => 'plan-section.png',
            'section_blade_file_name' => 'plan-section',
            'section_type' => 'section-plan',
        ];
        $section_data[] = [
            'section_name' => 'section-8',
            'section_order' => 9,
            'default_content' => '{"button":{"text":"Subscribe"},"text":{"text-1":"Try for free","text-2":"Lorem Ipsum is simply dummy text","text-3":"of the printing and typesetting industry","text-4":"Type your email address and click the button"},"custom_class_name":""}',
            'content' => '{"button":{"text":"Subscribe"},"text":{"text-1":"Try for free","text-2":"Lorem Ipsum is simply dummy text","text-3":"of the printing and typesetting industry","text-4":"Type your email address and click the button"},"custom_class_name":""}',
            'section_demo_image' => 'subscribe-part.png',
            'section_blade_file_name' => 'custome-subscribe-part',
            'section_type' => 'section-8',
        ];
        $section_data[] = [
            'section_name' => 'section-9',
            'section_order' => 10,
            'default_content' => '{"menu":[{"menu":"Facebook","href":"#"},{"menu":"LinkedIn","href":"#"},{"menu":"Twitter","href":"#"},{"menu":"Discord","href":"#"}],"custom_class_name":""}',
            'content' => '{"menu":[{"menu":"Facebook","href":"#"},{"menu":"LinkedIn","href":"#"},{"menu":"Twitter","href":"#"},{"menu":"Discord","href":"#"}],"custom_class_name":""}',
            'section_demo_image' => 'social-links.png',
            'section_blade_file_name' => 'custome-social-links',
            'section_type' => 'section-9',
        ];
        $section_data[] = [
            'section_name' => 'section-10',
            'section_order' => 11,
            'default_content' => '{"footer":{"logo":{"logo":"landing_logo.png"},"footer_menu":[{"id":1,"menu":"FIO Protocol","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":2,"menu":"Learn","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":3,"menu":"Foundation","data":[{"menu_name":"About Us","menu_href":"#"},{"menu_name":"Customers","menu_href":"#"},{"menu_name":"Resources","menu_href":"#"},{"menu_name":"Blog","menu_href":"#"}]}],"contact_app":[{"menu":"Contact","data":[{"id":1,"image":"app-store.png","image_href":"#"},{"id":2,"image":"google-pay.png","image_href":"#"}]}],"bottom_menu":{"text":"All rights reserved.","data":[{"menu_name":"Privacy Policy","menu_href":"#"},{"menu_name":"Github","menu_href":"#"},{"menu_name":"Press Kit","menu_href":"#"},{"menu_name":"Contact","menu_href":"#"}]}},"custom_class_name":""}',
            'content' => '{"footer":{"logo":{"logo":"landing_logo.png"},"footer_menu":[{"id":1,"menu":"FIO Protocol","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":2,"menu":"Learn","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":3,"menu":"Foundation","data":[{"menu_name":"About Us","menu_href":"#"},{"menu_name":"Customers","menu_href":"#"},{"menu_name":"Resources","menu_href":"#"},{"menu_name":"Blog","menu_href":"#"}]}],"contact_app":[{"menu":"Contact","data":[{"id":1,"image":"app-store.png","image_href":"#"},{"id":2,"image":"google-pay.png","image_href":"#"}]}],"bottom_menu":{"text":"All rights reserved.","data":[{"menu_name":"Privacy Policy","menu_href":"#"},{"menu_name":"Github","menu_href":"#"},{"menu_name":"Press Kit","menu_href":"#"},{"menu_name":"Contact","menu_href":"#"}]}},"custom_class_name":""}',
            'section_demo_image' => 'footer-section.png',
            'section_blade_file_name' => 'custome-footer-section',
            'section_type' => 'section-10',
        ];


        foreach($section_data as $section_key => $section_value)
        {

            LandingPageSection::create($section_value);
        }

        return true;
    }
    public static function getAdminPaymentSetting()
    {
        $data     = \DB::table('admin_payment_settings');
        $settings = [];
        if(\Auth::check())
        {
            $user_id = 1;
            $data    = $data->where('created_by', '=', $user_id);

        }
        $data = $data->get();
        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function getPaymentIsOn(){
        $payments = self::getAdminPaymentSetting();
        if(isset($payments['is_stripe_enabled']) && $payments['is_stripe_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_paypal_enabled']) && $payments['is_paypal_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_flutterwave_enabled']) && $payments['is_flutterwave_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_razorpay_enabled']) && $payments['is_razorpay_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_mercado_enabled']) && $payments['is_mercado_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_paytm_enabled']) && $payments['is_paytm_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_mollie_enabled']) && $payments['is_mollie_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_skrill_enabled']) && $payments['is_skrill_enabled'] == 'on'){
            return true;
        }elseif(isset($payments['is_coingate_enabled']) && $payments['is_coingate_enabled'] == 'on'){
            return true;
        }else{
            return false;
        }

    }
    public static function getSocialIcon($theme,$color){
        if($theme == 'theme1'){
            $black_icon =['color1','color2','color5'];
            if(in_array($color,$black_icon)){
                return 'black';
            }else{
                return 'white';
            }
        }

    }
    public static function getColorIcon($theme,$color){
        if($theme == 'theme1'){
            $black_icon =['color1','color2','color5'];
            if(in_array($color,$black_icon)){
                return 'black';
            }else{
                return 'white';
            }
        }
    }
    public static function getmSocialIcon($theme,$color){
        if($theme == 'theme1'){
            $black_icon =['color3','color5'];
            if(in_array($color,$black_icon)){
                return 'black';
            }else{
                return 'white';
            }
        }
    }

}
