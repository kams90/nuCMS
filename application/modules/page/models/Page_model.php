<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Page_model
 */
class Page_model extends MY_Model
{
    public $table = 'nu_page';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('language/language_model', 'language');
        $CI->load->model('page/page_translations_model', 'page_translations');

        // Relations
        $this->has_one['translation'] = array(
            'foreign_model'=>'Page_translations_model',
            'foreign_table'=>'nu_page_translations',
            'foreign_key'=>'page_id',
            'local_key'=>'id'
        );

        $this->has_many['translations'] = array(
            'foreign_model'=>'Page_translations_model',
            'foreign_table'=>'nu_page_translations',
            'foreign_key'=>'page_id',
            'local_key'=>'id'
        );

        parent::__construct();
        $this->timestamps = TRUE;
    }

    /**
     * Get validations rules
     *
     * @param string $action
     * @return array
     */
    public function get_rules($action = '', $id = 0)
    {
        $rules = array();

        $rules['title'] = array('field' => 'title', 'label' => lang('page.form.title'), 'rules' => 'required|trim|xss_clean');
        $rules['content'] = array('field' => 'content', 'label' => lang('page.form.content'), 'rules' => 'xss_clean');
        $rules['active'] = array('field' => 'active', 'label' => lang('page.form.active'), 'rules' => 'trim|xss_clean');
        $rules['meta_title'] = array('field' => 'meta_title', 'label' => lang('page.form.meta_title'), 'rules' => 'max_length[50]|trim|xss_clean');
        $rules['meta_keywords'] = array('field' => 'meta_keywords', 'label' => lang('page.form.meta_keywords'), 'rules' => 'trim|xss_clean');
        $rules['meta_description'] = array('field' => 'meta_description', 'label' => lang('page.form.meta_description'), 'rules' => 'max_length[160]|trim|xss_clean');

        return $rules;
    }
}

/* End of file Page_model.php */
/* Location: ./application/modules/page/models/Page_model.php */