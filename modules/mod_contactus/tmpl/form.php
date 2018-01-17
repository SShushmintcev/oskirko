<?php 
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
if (!isset($dependencys)) {
    $dependencys = array();
}
?>
<div id="contactus-form<?php if (isset($module->id)){echo $module->id;};?>" class="contactus-form contactus-form<?php if (isset($module->id)){echo $module->id;};?> <?php if (isset($fields->margin)){echo "contactus-".$fields->margin;}; ?>">
	<form  class="reg_form"  action="<?php echo JFactory::getURI();?>" id="contactusForm" onsubmit="contactus_validate(this); joomly_analytics(<?php echo $module->id;?>);" method="post" enctype="multipart/form-data">
		<div>
			<?php if (isset($fields->field))
				{	
					$i = 0;
					foreach ($fields->field as $k=>$f)
					{	
						switch ($f->type){
							case "Input":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<input type="text" placeholder="<?php echo $f->title; if ($f->required == 1){echo '*';};?>" class="contactus-fields <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?> value="<?php if (isset($data[$f->name])){echo $data[$f->name];};?>"/>
								</div>
						<?php break; 
							case "Email":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<input type="email" placeholder="<?php echo $f->title;if ($f->required == 1){echo '*';};?>" class="contactus-fields <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?> value="<?php if (isset($data[$f->name])){echo $data[$f->name];};?>" />
								</div>
						<?php break; 
							case "Phone":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<input type="tel" pattern="(\+?\d[- .\(\)]*){5,15}" placeholder="<?php echo $f->title;if ($f->required == 1){echo '*';};?>" class="contactus-fields <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?> value="<?php if (isset($data[$f->name])){echo $data[$f->name];};?>" />
								</div>
						<?php break; 
							case "Textarea":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<textarea  placeholder="<?php echo $f->title;if ($f->required == 1){echo '*';};?>" class="contactus-textarea <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" name="<?php echo $f->name;?>" cols="120" rows="6" <?php if ($f->required == 1){echo "required";}; ?>><?php if (isset($data[$f->name])){echo $data[$f->name];};?></textarea>
								</div>
						<?php break; 
							case "Date":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<input type="text" placeholder="<?php echo $f->title; if ($f->required == 1){echo '*';};?>" class="contactus-fields constructor <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" onfocus="(this.type='date')" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?> value="<?php if (isset($data[$f->name])){echo $data[$f->name];};?>" />
								</div>	
						<?php break; 
							case "Time":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<input type="text" placeholder="<?php echo $f->title; if ($f->required == 1){echo '*';};?>" class="contactus-fields constructor <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" onfocus="(this.type='time')" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?> value="<?php if (isset($data[$f->name])){echo $data[$f->name];};?>" />
								</div>	
						<?php break; 
							case "Checkbox":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div checkbox-container">
									<label class="contactus-checkbox-label" ><span class="contactus-sp"><?php echo $f->title;?></span><input type="checkbox" class="contactus-fields <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" value="<?php echo JText::_('MOD_CONTACTUS_CHECKBOX_YES');?>" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?>/></label>
								</div>		
						<?php break; 
							case "Select":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>	
								<div class="joomly-contactus-div select-container">
									<select class="contactus-select <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>" name="<?php echo $f->name;?>" <?php if ($f->required == 1){echo "required";}; ?>>
									<option <?php if ($f->required == 1){echo 'selected="selected" disabled="disabled" value=""';}; ?>><?php echo $f->title; if ($f->required == 1){echo '*';};?></option>	
									<?php foreach ($f->options as $option)
									{?>
										<option><?php echo $option;?></option>	
									<?php }?>
									</select>
								</div>
						<?php break; 
							case "Text":
								if ($f->dependency != "")
								{
									$temp_d = explode(":",$f->dependency);
									$dependencys[$temp_d[0].$module->id][] = array("value"=>$temp_d[1], "child" => $f->name.$module->id);
								} ?>
								<div class="joomly-contactus-div">
									<p class="joomly-p <?php echo $f->name.$module->id;?>" data-id="<?php echo $k.$module->id;?>"><?php echo $f->title;?></p>
								</div>						
						<?php break;		
						}
						$i+=1;
					 }
				}?>
			<?php if (($fields->uploader !==null ? $fields->uploader : 1)  == 1){?>
				<div class="contactus-file"  >
					<span id="file-contactus<?php if (isset($module->id)){echo $module->id;};?>" class="contactus-file" >
						<label class="contactus-file-label" id="file-label<?php if (isset($module->id)){echo $module->id;};?>"><?php echo JText::_('MOD_CONTACTUS_ADD_FILES'); ?></label>
						<label class="contactus-file" style="background-color: <?php echo ($fields->color !==null ? $fields->color : "#21ad33");?>;" for="file-input<?php if (isset($module->id )){echo $module->id;};?>"><?php echo JText::_('MOD_CONTACTUS_BROWSE'); ?></label>
						<input type="file" name="file[]" id="file-input<?php if (isset($module->id)){echo $module->id;};?>" class="contactus-file" onchange="contactus_uploader(<?php if (isset($module->id )){echo $module->id;};?>)" multiple  >			
					</span>
				</div>
			<?php }?>
			<?php if ((isset($fields->personal) ? $fields->personal : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<label class="contactus-label-<?php if (isset($fields->margin)){echo $fields->margin;}; ?>"><a href="<?php if (!empty($fields->personal_link)){ echo $fields->personal_link;};?>" target="_blank"><?php echo JText::_('MOD_CONTACTUS_CONSENT_PERSONAL_DATA');?></a><input type="checkbox" class="joomly-contactus-checkbox" checked required></label>
				</div>	
			<?php }?>
			<?php if ((($fields->captcha !==null ? $fields->captcha : 1)  == 1) && ($fields->captcha_size !== 'invisible')){?>
				<div class="joomly-contactus-div">
					<div class="g-recaptcha <?php if (isset($fields->margin)){echo "contactus-".$fields->margin;}; ?>" data-sitekey="<?php if (isset($fields->captcha_sitekey)){echo $fields->captcha_sitekey;}?>" data-size="<?php if (isset($fields->captcha_size)){echo $fields->captcha_size;}?>"></div>
				</div>
			<?php }?>			
		</div>
		<div>
			<button type="submit" value="save" class="<?php if ((isset($fields->captcha_size)) && ($fields->captcha_size == 'invisible')){echo 'g-recaptcha';};?> contactus-button contactus-submit contactus-<?php if (isset($fields->margin)){echo $fields->margin;}; ?>" style="background-color: <?php echo (isset($fields->color) ? $fields->color : "#21ad33");?>;" id="button-contactus-lightbox<?php if (isset($module->id)){echo $module->id;};?>" <?php if (($fields->captcha !==null ? $fields->captcha : 1)  == 1){echo "data-callback='submitForm' data-sitekey='" . $fields->captcha_sitekey . "'";};?>><?php if (!empty($fields->button_send)) { echo $fields->button_send;} else {echo  JText::_('MOD_CONTACTUS_SEND');};?></button>
		</div>
			<input type="hidden" name="option" value="com_contactus" />
			<input type="hidden" name="layout" value="form" />
			<input type="hidden" name="module_id" value="<?php echo $module->id;?>" />	
			<input type="hidden" name="module_title" value="<?php echo $module->title;?>" />	
			<input type="hidden" name="module_hash" value="<?php echo JUserHelper::getCryptedPassword(JFactory::getURI()->toString());?>" />
			<input type="hidden" name="page" value="<?php echo urldecode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" />
			<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>" />
			<input type="hidden" name="task" value="add.save" />
			<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
<div class="contactus-alert" id="contactus-sending-alert<?php if (isset($module->id)){echo $module->id;};?>">
	<div class="contactus-lightbox-caption" style="background-color:<?php echo $alert_message_color;?>;">
		<div class="contactus-lightbox-cap"><h4 class="contactus-lightbox-text-center"><?php if (isset($alert_headline_text)){echo $alert_headline_text;};?></h4></div><div class="contactus-lightbox-closer"><i id="contactus-lightbox-sending-alert-close<?php if (isset($module->id)){echo $module->id;};?>" class="fa fa-close fa-1x"></i></div>
	</div>
	<div class="contactus-alert-body">
		<p class="contactus-lightbox-text-center"><?php if (isset($alert_message_text)){echo $alert_message_text;};?></p>
	</div>
</div>
<script type="text/javascript">
var dependencys = <?php echo json_encode($dependencys);?>;
set_dependencys(dependencys);
var contactus_module_id = <?php if (isset($module->id)){echo $module->id;};?>,
files_added = "<?php echo JText::_('MOD_CONTACTUS_FILES_ADDED');?>";
type_field = "<?php echo JText::_('MOD_CONTACTUS_TYPE_FIELD');?>";
captcha_error = "<?php echo JText::_('MOD_CONTACTUS_CAPTCHA_ERROR');?>";
filesize_error = "<?php echo JText::_('MOD_CONTACTUS_FILESIZE_ERROR');?>";
var uploads_counter = uploads_counter || [];
uploads_counter[contactus_module_id] = 0;
var contactus_params = contactus_params || [];
contactus_params[contactus_module_id] = <?php echo json_encode($contactus_params);?>;
contactus_form();
</script>

