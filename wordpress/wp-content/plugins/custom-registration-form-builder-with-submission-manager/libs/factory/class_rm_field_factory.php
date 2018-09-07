<?php

/**
 * Description of RM_Field_Factory
 *
 */
class RM_Field_Factory {
    
    protected $db_field;
    protected $field_name;
    protected $field_options;
    protected $gopts;
    protected $opts;
    protected $x_opts;
    protected $prevent_value_update;
            
    public function __construct($db_field,$opts, $prevent_value_update = false){
        $this->prevent_value_update = $prevent_value_update;
        $this->db_field= $db_field;
        $this->gopts= new RM_Options;
        $this->opts= $opts;
        $this->field_options = maybe_unserialize($db_field->field_options);
        $temp_field = new RM_Fields;
        $valid_field_options = $temp_field->get_valid_options();
        
        if($this->field_options) {
            foreach($valid_field_options as $option_name) {
                if(!isset($this->field_options->$option_name)) {
                    $this->field_options->$option_name = null;
                }
            }
        }
        
        $this->field_name= $db_field->field_type."_".$db_field->field_id;
        $this->db_field->field_value = maybe_unserialize($db_field->field_value);
        if(isset($this->field_options->icon))
            $this->x_opts = (object)array('icon' => $this->field_options->icon);
        else
            $this->x_opts = null;
        
        if(!isset($this->opts['value']))
            $this->opts['value'] = null;
    }
    
     public function create_binfo_field(){
        if(is_user_logged_in() && !isset($_GET['form_prev']))
        {
            $current_user = wp_get_current_user();  
            $user_binfo= get_user_meta($current_user->ID, 'description', true);
            $this->opts['value'] = ($user_binfo == '')? $this->opts['value'] : $user_binfo;
        }
       return new RM_Frontend_Field_Base($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
   
     }     
    
    public function create_price_field(){
        $currency_pos = $this->gopts->get_value_of('currency_symbol_position');
        $currency_symbol = $this->gopts->get_currency_symbol();
        return new RM_Frontend_Field_Price($this->db_field->field_id, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $currency_pos, $currency_symbol, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts); 
    }
    
    public function create_file_field(){
        return null;
    }
    
    public function create_select_field(){
        if(is_user_logged_in() && !$this->prevent_value_update && !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
            $current_user = wp_get_current_user();  
            $select_field= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
            $this->opts['value'] = ($select_field == '')? $this->opts['value'] : $select_field;
        }
        return new RM_Frontend_Field_Select($this->db_field->field_id, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_multidropdown_field(){
      
        $this->opts['multiple']='multiple';
        return null;
    }
    
    public function create_repeatable_field(){
        return null;
    }
    
    public function create_base_field(){
        if(is_user_logged_in() && !$this->prevent_value_update && !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
            $current_user = wp_get_current_user();  
            $user_base_info= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
            $this->opts['value'] = ($user_base_info == '')? $this->opts['value'] : $user_base_info;
        }
        return new RM_Frontend_Field_Base($this->db_field->field_id,'Textbox', $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_phone_field(){
       return null;
    }
    
    public function create_mobile_field(){
        return null;
    }
    
    public function create_nickname_field(){
        if(is_user_logged_in() && !isset($_GET['form_prev']))
        {
            $current_user = wp_get_current_user();  
            $user_nickname= get_user_meta($current_user->ID, 'nickname', true);
            $this->opts['value'] = ($user_nickname == '')? $this->opts['value'] : $user_nickname;
        }
       return new RM_Frontend_Field_Base($this->db_field->field_id,'Nickname', $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_image_field(){
        return null;
    }
    
    public function create_facebook_field(){
        return null;
    }
    
    public function create_website_field(){
        $this->opts['Pattern'] = "((?:https?\:\/\/|[wW][wW][wW]\.)(?:[-a-zA-Z0-9]+\.)*[-a-zA-Z0-9]+.*)";
        if(is_user_logged_in() && !isset($_GET['form_prev']))
        {
            $current_user = wp_get_current_user(); 
            $this->opts['value'] = isset($current_user->user_url)? $current_user->user_url : null;
        }
        return new RM_Frontend_Field_Base($this->db_field->field_id,'Website', $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_twitter_field(){
        return null;
    }
    
    public function create_google_field(){
        return null;
    }
    
    public function create_instagram_field(){
       return null;
    }
    
    public function create_linked_field(){
        return null;
    }
    
    public function create_soundcloud_field(){
        return null;
    }
    
    public function create_youtube_field(){
        return null;
        
    }
    
    public function create_vkontacte_field(){
        return null;
        
    }
    
    public function create_skype_field(){
        return null;
    }
    
    public function create_bdate_field(){
        return null;
    }
    
    public function create_secemail_field(){
        return null;
    }
    
    public function create_gender_field(){
        return null;
    }
    
    public function create_terms_field(){
        $this->opts['cb_label'] = isset($this->field_options->tnc_cb_label)?$this->field_options->tnc_cb_label:null;
        return new RM_Frontend_Field_Terms($this->db_field->field_id, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_language_field(){
       return null;
    }
    
    public function create_radio_field(){
        if(is_user_logged_in() && !$this->prevent_value_update && !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
            $current_user = wp_get_current_user();  
            $radio_info= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
            $this->opts['value'] = ($radio_info == '')? $this->opts['value'] : $radio_info;
        }
        return new RM_Frontend_Field_Radio($this->db_field->field_id, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_checkbox_field(){
        
         if(is_user_logged_in() && !$this->prevent_value_update &&  !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
                $current_user = wp_get_current_user();  
                $checkbox_info= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
                $this->opts['value'] = ($checkbox_info == '')? $this->opts['value'] : $checkbox_info;  
        }
      
       
        return new RM_Frontend_Field_Checkbox($this->db_field->field_id, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
      
        }
 
    public function create_shortcode_field(){
        return null;
    }
    
    public function create_divider_field(){
       return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts, ' <div class="rmrow rm-full-width"><hr class="rm_divider" width="100%" size="8" align="center"></div>', $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_spacing_field(){
       return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts, '<div class="rmrow rm-full-width"><div class="rm_spacing"></div></div>', $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_htmlh_field(){
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_htmlp_field(){
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_time_field(){
        return null;
    }
    
    public function create_rating_field(){
        return null;
    }
    
    public function create_custom_field(){
               return null;
    }
    
    public function create_email_field(){
        // in this case pre-populate the primary email field with logged-in user's email.
        if($this->db_field->is_field_primary)
        {
            if(is_user_logged_in() && !isset($_GET['form_prev']))
            {
                $current_user = wp_get_current_user();                            
                $this->opts['value'] = $current_user->user_email;
            }
        }
        else
        {
            if(is_user_logged_in()  && !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
                $current_user = wp_get_current_user();  
                $user_emailinfo= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
                $this->opts['value'] = ($user_emailinfo == '')? $this->opts['value'] : $user_emailinfo;
            }
        }
         return new RM_Frontend_Field_Base($this->db_field->field_id,$this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_address_field(){
        $field= $this->create_geo_field();
        return $field;
    }
    
    public function create_map_field(){ 
        $field= $this->create_geo_field();       
        return $field;
    }
    
    public function create_geo_field(){
        $service = new RM_Front_Form_Service; 
        return new RM_Frontend_Field_GGeo($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $service->get_setting('google_map_key'), $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    
    public function create_textbox_field(){
        $field= $this->create_base_field();
        return $field;
    }
    
    
    public function create_fname_field(){
       if(is_user_logged_in() && !isset($_GET['form_prev']))
        {
            $current_user = wp_get_current_user();  
            $user_fname= get_user_meta($current_user->ID, 'first_name', true);
            $this->opts['value'] = ($user_fname == '')? $this->opts['value'] : $user_fname;
        }
      return new RM_Frontend_Field_Base($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
  
    }
    
    public function create_lname_field(){
        if(is_user_logged_in() && !isset($_GET['form_prev']))
        {
            $current_user = wp_get_current_user();  
            $user_lname= get_user_meta($current_user->ID, 'last_name', true);
            $this->opts['value'] = ($user_lname == '')? $this->opts['value'] : $user_lname;
        }
      return new RM_Frontend_Field_Base($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
  
    }
    
    public function create_hidden_field(){
        return new RM_Frontend_Field_Hidden($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_richtext_field(){ 
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->field_value, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_default_field(){
        if(is_user_logged_in() && !$this->prevent_value_update && !isset($_GET['form_prev']) && $this->db_field->field_show_on_user_page && !empty($this->field_options->field_meta_add)){
         $current_user = wp_get_current_user();  
         $user_defaultinfo= get_user_meta($current_user->ID, $this->field_options->field_meta_add, true);
        
         $this->opts['value'] = ($user_defaultinfo == '')? $this->opts['value'] : $user_defaultinfo;
        }
        return new RM_Frontend_Field_Base($this->db_field->field_id, $this->db_field->field_type, $this->db_field->field_label, $this->opts, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_link_field(){
       $href=''; $target='';
      // print_r($this->field_options);
       if($this->field_options->link_type=="url"){
           $href= $this->field_options->link_href;
       } else if($this->field_options->link_type=="page"){
           $href= get_permalink($this->field_options->link_page);
       }
       
       if($this->field_options->link_same_window!=1){
           $target='target="_blank"';
       }
       
       $link_html= '<a '.$target.' href="' ;
       $link_html .= $href.'">';
       $link_html.= $this->db_field->field_label.'</a>';
       return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized',$this->db_field->field_label, $this->opts,$link_html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    // Special function for YouTube Widgets
    public function create_youtubev_widget(){
        $class=  isset($options['class'])?$options['class'].' rm-full-width':'rm-full-width';
        $width= !empty($this->field_options->yt_player_width)?$this->field_options->yt_player_width:'560';
        $height= !empty($this->field_options->yt_player_height)?$this->field_options->yt_player_height:'315';
        $video_id= RM_Utilities::extract_youtube_embed_src($this->db_field->field_value);
        $src= "https://www.youtube.com/embed/".$video_id."?autoplay=".$this->field_options->yt_auto_play; 
        $src .= $this->field_options->yt_repeat ? "&playlist=".$video_id."&loop=1"  : '';
        $src .= empty($this->field_options->yt_related_videos) ? '&rel=0' : '';
        
        $iframe= "<div class='rmrow'><iframe width='".$width."' height='".$height."' src='".$src."' frameborder='0' allowfullscreen></iframe></div>";
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized',$this->db_field->field_label, $this->opts,$iframe, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_youtubev_field(){
         return $this->create_youtubev_widget();
     }
    
    public function create_iframe_field(){  
        $class=  isset($options['class'])?$options['class'].' rm-full-width':'rm-full-width';
        $width= !empty($this->field_options->if_width)?$this->field_options->if_width:'auto';
        $height= !empty($this->field_options->if_height)?$this->field_options->if_height:'auto';
        $src= $this->db_field->field_value; 
        $link_type= RM_Utilities::check_src_type($this->db_field->field_value);
        
        if($link_type === 'youtube'){
            $video_id= RM_Utilities::extract_youtube_embed_src($this->db_field->field_value);
            $src= "http://www.youtube.com/embed/".$video_id;        
        }
        elseif($link_type === 'vimeo') {
            $video_id= RM_Utilities::extract_vimeo_embed_src($this->db_field->field_value);
            $src= "http://player.vimeo.com/video/".$video_id; 
        }
        $iframe= "<div class='rmrow'><iframe width='".$width."' height='".$height."' src='".$src."' frameborder='0' allowfullscreen></iframe></div>";
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized',$this->db_field->field_label, $this->opts,$iframe, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    
    public function create_pricev_field(){ 
        $gopts= new RM_Options(); 
        $currency_symbol= $gopts->get_currency_symbol();
        $class=  $this->field_options->field_css_class;
        $html= "<div class='rmrow'><div class='rm-total-price-widget'><span>$currency_symbol</span><span class='rm-total-price ".$class."'></span></div></div>";
        wp_enqueue_script("rm_price_widget_script",RM_BASE_URL."public/js/price_widget.js");
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_subcountv_field(){
        $class=  $this->field_options->field_css_class;
        $exp_str= RM_Utilities::get_form_expiry_message($this->db_field->form_id); 
        $html= "<div class='rmrow rm_expiry_stat_container $class '>$exp_str</div>";
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_mapv_field(){
        $style='';
        $class=  $this->field_options->field_css_class;
        $address= $this->db_field->field_value;
        $zoom= empty($this->field_options->zoom) ? 17 : $this->field_options->zoom;
        $width= empty($this->field_options->width) ? 250 : $this->field_options->width;
        if($width>0)
            $style="width:$width".'px';
        $service= new RM_Services();
        $gmap_api_key= $service->get_setting('google_map_key');
        $element_id='';
      
        if(!empty($address) && !empty($gmap_api_key)){ 
             wp_enqueue_script ('google_map_key', 'https://maps.googleapis.com/maps/api/js?key='.$gmap_api_key.'&libraries=places');
             wp_enqueue_script("rm_map_widget_script",RM_BASE_URL."public/js/map_widget.js");
             $element_id= 'map'.$this->db_field->field_id;
             echo '<script>jQuery(document).ready(function(){rm_show_map_widget("'.$element_id.'",["'.$address.'"],'.$zoom.')});</script>';
        }
       
        $html= "<div class='rmrow'><div style='$style' class='rm_mapv_container $class '><div id='".$element_id."' class='rm-map-widget'></div></div></div>";
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_imagev_field(){ 
        $class=  $this->field_options->field_css_class;
        $width= $this->field_options->img_size;
        $img='';$styles=array();$href='';$caption='';$title='';$shape_class='';
        $shape_class='';
        $this->field_options->border_width= $this->field_options->border_width=='' ? 5 : $this->field_options->border_width.'px';
        if($this->field_options->img_effects_enabled){
            $styles['border:']= 'solid'; 
            $styles['border-color:']= '#'.$this->field_options->border_color;
            $styles['border-width:']= $this->field_options->border_width;
            if(strtolower($this->field_options->border_shape)=="circle")
                $shape_class= 'imgv_shape_circle';
            else if(strtolower($this->field_options->border_shape)=="square")
                $shape_class= 'imgv_shape_square';  
        }
        
       if(strtolower($width)!='thumbnail'){
            $styles['width:']= $width;
        }

        if($this->field_options->link_type=="url"){
           $href= $this->field_options->link_href;
        } else if($this->field_options->link_type=="page"){
           $href= get_permalink($this->field_options->link_page);
        }
        
        $post = get_post($this->db_field->field_value);
        if($this->field_options->img_caption_enabled){
            $caption= $post->post_excerpt; 
        }
        
        if($this->field_options->img_title_enabled){
            $title= $post->post_title;
        }
       
       $style_str='style="';
       foreach($styles as $key=>$val){
           $style_str .= $key.$val.';';
       }
       $style_str .= '"';
        if(strtolower($width)=='thumbnail'){
            $src_array=wp_get_attachment_image_src($this->db_field->field_value,'thumbnail');
            if(is_array($src_array)){
                $src= $src_array[0];
                $img= "<img title='".$title."' $style_str src='".$src."' />";
            }
        }
        else{
             $src_array=wp_get_attachment_image_src($this->db_field->field_value,'full');
             if(is_array($src_array)){
                 $src= $src_array[0];
                 $img= "<img title='".$title."' $style_str  src='".$src."' />"; 
             }
        }
        
        if(!empty($href)){ 
            if($this->field_options->img_pop_enabled==1){
                add_thickbox();
                $href= add_query_arg("TB_iframe",'true',$href);
                $img= '<a class="thickbox" href="'.$href.'">'.$img.'</a>';
            } else
            $img= '<a target="_blank" href="'.$href.'">'.$img.'</a>';
        } else if($this->field_options->img_pop_enabled==1){
            add_thickbox();
            $src_array= wp_get_attachment_image_src($this->db_field->field_value,'full');
            $src= add_query_arg("TB_iframe",'true',$src_array[0]);
            $img= '<a class="thickbox" href="'.$src.'">'.$img.'</a>';
        }
       
        
     
        $html = "<div class='rmrow'><figure class='rm-image-widget wp-caption ".$shape_class."' ".$class.">$img"."<figcaption class='wp-caption-text'>".$caption."</figcaption></figure></div>";
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized',$this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_form_chart_field(){ 
        $class=  $this->field_options->field_css_class;
        $chart_type= $this->db_field->field_value;
        $field_label= $this->db_field->field_label;
        $stats_service= new RM_Analytics_Service();
        if($chart_type=="sot"){
            $time_range= $this->field_options->time_range;
            $chart_html= $stats_service->{$chart_type}($this->db_field->form_id,null,$time_range);
        }
        else
            $chart_html= $stats_service->{$chart_type}($this->db_field->form_id);

        $html= "<div class='rmrow rm-box-graph $class'><div class='rm-box-title'>$field_label</div><div id='rm_".$chart_type."_div'></div></div> $chart_html"; 
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_formdata_field(){
        $html= RM_Utilities::get_formdata_widget_html($this->db_field->field_id);
        return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
    
    public function create_feed_field(){
      $html = RM_Utilities::get_feed_widget_html($this->db_field->field_id); 
      return new RM_Frontend_Field_Visible_Only($this->db_field->field_id,'HTMLCustomized', $this->db_field->field_label, $this->opts,$html, $this->db_field->page_no, $this->db_field->is_field_primary, $this->x_opts);
    }
   
}
