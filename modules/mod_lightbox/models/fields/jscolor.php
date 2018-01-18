<?php
/**
 * @package Huge IT portfolio
 * @author Huge-IT
 * @copyright (C) 2014 Huge IT. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @website		http://www.huge-it.com/
 **/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.filesystem.folder');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

class JFormFieldJSColor extends JFormField {

    protected $type = 'jscolor';

    public function getInput() {
        $doc = JFactory::getDocument();
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/admin.js");
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/jscolor/jscolor.js");
        $doc->addScript(JURI::root(true) . "/media/mod_lightbox/js/simple-slider.js");

        JHtml::stylesheet('media/mod_lightbox/css/simple-slider.css');
        JHtml::stylesheet('media/mod_lightbox/css/admin.style.css');

        $name = $this->element['name'];
        $type_ = $this->element['type_'];
        $id = $this->element['id'];
        $this->element['class'] = trim($this->element['class']);
        $for = $this->element['for'] ? ' for="' . (string) $this->element['for'] . '"' : '';
        $class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
        $name = $this->element['name'] ? 'name="' . (string) $this->element['name'] . '"' : '';
        $id = $this->element['id'] ? 'id="' . (string) $this->element['id'] . '"' : '';
        $value = $this->element['value'] ? 'value="' . (string) $this->element['value'] . '"' : '';
        $checked = $this->element['checked'];
        $default = $this->element['default'];

        if ($type_ == "light_box_style") {
            $options = array(
                JHtml::_('select.option', '1', '1'),
                JHtml::_('select.option', '2', '2'),
                JHtml::_('select.option', '3', '3'),
                JHtml::_('select.option', '4', '4'),
                JHtml::_('select.option', '5', '5')
            );

            $html = '<select  id="' . $this->id . '" name="' . $this->name . '" style="width:126px">';
            foreach ($options as $i => $option) {
                if ($this->value == $option->value) {
                    $html.= '<option name="' . $this->name . '" value="'. $option->value .'"  selected>' . $option->value . '</option>';
                } else {
                    $html.= '<option name="' . $this->name . '" value="'. $option->value .'" >' . $option->value . '</option>';
                }
            }

            $html.= '</select>';

            return $html;

        } elseif ($type_ == "lightbox_transition_list") {
            $options = array(
                JHtml::_('select.option', 'elastic', 'Elastic'),
                JHtml::_('select.option', 'fade', 'Fade'),
                JHtml::_('select.option', 'none', 'None'),
            );

            $html = '<select id="' . $this->id . '" name="' . $this->name . '" for="' . $this->for . '" style="width:126px">';
            foreach ($options as $i => $option) {
                if ($this->value == $option->value) {
                    $html.= '<option name="' . $this->name . '" value="'. $option->value .'"  selected>' . $option->value . '</option>';
                } else {
                    $html.= '<option name="' . $this->name . '" value="'. $option->value .'" >' . $option->value . '</option>';
                }
            }

            $html.= '</select>';

            return $html;
        } elseif ($type_ == "number") {
            return '<input style="width:115px" type="number"  id ="' . $this->id . '" name="' . $this->name . '"  ' . $class . ' ' . $for . ' ' . $value . '/>';
        } elseif ($type_ == "checkbox") {
            // $script = $this->element['script'] ? $this->element['script'] : '';
            $checked = $this->value == '1' ? 'checked' : '';
            return '<input type="checkbox" name="' . $this->name . '" id="' . $this->id . '" value="' . $this->value . '" value="' . $this->value . '" ' . $default . '' . $class . $checked . '/>';
        } elseif ($type_ == "light_box_opacity_text") {
            return '<div style="float: left;" class="slider-container">'
                    . '<input  value="' . $this->value . '"  name="' . $this->name . '"  id="light_box_opacity" data-slider-highlight="true"  data-slider-values="0,10,20,30,40,50,60,70,80,90,100" type="text" data-slider="true" style="display: none;"/>'
                    . '<span>' . $this->value . '%</span></div>';
        } elseif ($type_ == "list") {
            return '<div  style="width:115px" class="has-background"><div id="view-style-block" class="has-background">
					<ul>
						<li data-id="1" class="active"><img src="../media/mod_lightbox/css/images/view1.jpg"></li>
						<li data-id="2"><img src="../media/mod_lightbox/css/images/view2.jpg"></li>
						<li data-id="3"><img src="../media/mod_lightbox/css/images/view3.jpg"></li>
						<li data-id="4"><img src="../media/mod_lightbox/css/images/view4.jpg"></li>
						<li data-id="5"><img src="../media/mod_lightbox/css/images/view5.jpg"></li>
					</ul>
				</div></div>';
        } elseif ($type_ == "radio") {
            $options = array(
                JHtml::_('select.option', '1', '1'),
                JHtml::_('select.option', '2', '2'),
                JHtml::_('select.option', '3', '3'),
                JHtml::_('select.option', '4', '4'),
                JHtml::_('select.option', '5', '5'),
                JHtml::_('select.option', '6', '6'),
                JHtml::_('select.option', '7', '7'),
                JHtml::_('select.option', '8', '8'),
                JHtml::_('select.option', '9', '9')
            );

            $html = '<div style="float: left;" ><table><tbody><tr>';

            foreach ($options as $i => $option){

            	if ($i <= 2) {
		            if ($this->value == $option->value) {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'"  checked /></td>';
		            } else {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'" /></td>';
		            }

		            if ($i == 2) {
			            $html .= '</tr>';
		            }
	            }

	            if ($i > 2 && $i <= 5){

		            if ($i == 3) {
			            $html .= '<tr>';
		            }

		            if ($this->value == $option->value) {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'"  checked /></td>';
		            } else {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'" /></td>';
		            }

		            if ($i == 5) {
			            $html .= '</tr>';
		            }
	            }

	            if ($i > 5){
		            if ($i == 6) {
			            $html .= '<tr>';
		            }
		            if ($this->value == $option->value) {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'"  checked /></td>';
		            } else {
			            $html.= '<td style="width:25px"><input type="radio" id="slideshow_title_top-left" name="' . $this->name . '" value="'. $option->value .'" /></td>';
		            }
	            }
            }

            $html .= '</tr></tbody></table></div>';

            return $html;
        } elseif ($type_ == "text") {
            return '<input  style="width:115px" type="text"  id ="' . $this->id . '" name="' . $this->name . '" ' . $value . ' "' . $class . '" "' . $for . '"/>';
        } elseif ($type_ == "label") {
            return '<label type="label"  id ="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" "' . $class . '" "' . $for . '"  style="margin-top:0px"/>';
        }
    }

}
