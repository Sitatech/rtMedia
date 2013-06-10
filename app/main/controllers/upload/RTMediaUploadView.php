<?php

/**
 * Description of BPMediaUploadView
 *
 * @author joshua
 */
class RTMediaUploadView {
	
	private $attributes;

    function __construct($attr) {
		
		$this->attributes = $attr;
    }

    public function render($template_name) {
        $tabs = array(
          'file_upload' => array( 'title' => __('File Upload','rt-media'), 'content' => '<div id="drag-drop-area"><input type="file" name="rt_media_file" class="rt-media-upload-input rt-media-file" /><input id="browse-button" type="button" value="Upload Media" class="button"></div>' ),
          'link_input' => array( 'title' => __('Insert from URL','rt-media'),'content' => '<input type="url" name="bp-media-url" class="rt-media-upload-input rt-media-url" />' ),
        );
        $tabs = apply_filters('bp_media_upload_tabs', $tabs );

        $mode = ( isset($_GET['mode']) &&  array_key_exists($_GET['mode'], $tabs) ) ? $_GET['mode']:'file_upload';
        $attr = $this->attributes;
		include $this->locate_template($template_name);
    }

    protected function locate_template($template) {
        $located = '';
		
		$template_name = $template . '.php';
		
		if (!$template_name)
			$located = false;
		if (file_exists(STYLESHEETPATH . '/rt-media/' . $template_name)) {
			$located = STYLESHEETPATH . '/rt-media/' . $template_name;
		} else if (file_exists(TEMPLATEPATH . '/rt-media/' . $template_name)) {
			$located = TEMPLATEPATH . '/rt-media/' . $template_name;
		} else {
			$located = RT_MEDIA_PATH . 'templates/upload/' . $template_name;
		}

        return $located;
    }

}

?>