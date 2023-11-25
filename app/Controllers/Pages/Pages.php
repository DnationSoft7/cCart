<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

class Pages extends BaseController {

    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function page($slug){
        $table = DB()->table('cc_pages');
        $page = $table->where('slug',$slug)->get()->getRow();

        $data['page_title'] = $page->page_title;
        $data['pageData'] = $page;

        $data['keywords'] = $page->meta_keyword;
        $data['description'] = $page->meta_description;
        $data['title'] = $page->meta_title;

        echo view('Theme/'.get_lebel_by_value_in_settings('Theme').'/header',$data);
        if (!empty($page->temp)){
            echo view('Theme/'.get_lebel_by_value_in_settings('Theme').'/Page/'.$page->temp);
        }else{
            echo view('Theme/'.get_lebel_by_value_in_settings('Theme').'/Page/default',$data);
        }
        echo view('Theme/'.get_lebel_by_value_in_settings('Theme').'/footer');
    }




}
