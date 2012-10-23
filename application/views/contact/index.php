<h2 class="underline">Get in touch!</h2>
<div id="Form_Block" style="padding: 0 15px;">
    <p>Because every website needs one, right?</p>
    <div class="validate_errors alert-error" style="display:none;"></div>
    <?php echo form_open(base_url('contact/submit'), array('id' => 'contact', 'class' => 'formular')); ?>
        <div class="form-item" style="margin-top:30px;">
            <label for="name"><span>*</span>&nbsp;Your Name</label>
            <input id="name" name="name" type="text" class="validate[required] text">
        </div>
        <div class="form-item" style="margin-top:20px;">
            <label for="email"><span>*</span>&nbsp;Your Email</label>
            <input id="email" name="email" type="text" class="validate[required,custom[email]] text">
        </div>
        <div class="form-item" style="margin-top:20px;">
   	    <label for="subject"><span>*</span>&nbsp;Subject</label>
            <input id="subject" name="subject" type="text" class="validate[required, maxSize[6], minSize[32]] text" style="width: 375px;" maxlength="32">
        </div>
   	<div class="form-item">
	    <label for="msg"><span>*</span>&nbsp;Message</label>
            <textarea id="msg" name="msg" class="validate[required, minSize[32]] textarea"maxlength="500"></textarea>
        </div>
        <label id="required_label"><span>*</span>Denotes a required field.</label>
        <input id="contact-submit" class="submit button" type="submit" value="Submit!" style="margin-right: 150px;float: right;" />
    <?php echo form_close();?>
</div>