<?php

class Class_Pi_Dcw_Checkout{

    public $plugin_name;

    private $setting = array();

    private $active_tab;

    private $this_tab = 'checkout';

    private $tab_name = "Checkout setting";

    private $setting_key = 'checkout_setting';

    private $pages =array();

   
    
    private $pro_version = false;

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;


        $this->pages = $this->get_pages();
        
        $this->active_tab = (isset($_GET['tab'])) ? sanitize_text_field($_GET['tab']) : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),6);

        $this->settings = array(
            array('field'=>'sunday', 'class'=> 'bg-secondary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__('Checkout field setting','pisol-dtt'), 'type'=>'setting_category'),
            array('field'=>'pi_dcw_remove_order_comment','desc'=>'Remove order comment from the checkout field', 'label'=>__('Remove order comment','pi-dcw'),'type'=>'switch','default'=>0),
            array('field'=>'pi_dcw_remove_have_coupon','desc'=>'Remove Have a Coupon field from the checkout page', 'label'=>__('Remove coupon field from checkout page','pi-dcw'),'type'=>'switch','default'=>0),
            
        );
        $this->register_settings();
        
        
    }

    function get_pages(){
        $pages = get_pages( );
        $pages_array = array(""=>__("Select page","pi-dcw"));
        if($pages){
            foreach ( $pages as $page ) {
                $pages_array[$page->ID] = $page->post_title;
            }
        }
        return $pages_array;
    }

    

    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class=" px-3 text-light d-flex align-items-center  border-left border-right  <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
            <?php _e( $this->tab_name, 'http2-push-content' ); ?> 
        </a>
        <?php
    }

    function tab_content(){
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_dcw($setting, $this->setting_key);
            }
        ?>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    
}

new Class_Pi_Dcw_Checkout($this->plugin_name);