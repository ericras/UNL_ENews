<script>
    require(['jquery', 'jqueryui'], function($) {
        $("#releaseDate").datepicker({
            showOn: 'both',
            buttonImage: '<?php echo UNL_ENews_Controller::getURL(); ?>css/images/x-office-calendar.png',
            dateFormat: 'yy-mm-dd',
            buttonImageOnly: true
        });
        require(["<?php echo UNL_ENews_Controller::getURL();?>js/preview.js"], function(preview){
            preview.initialize();
        });
    });
</script>

<div id="newsletterDetails" class="wdn-grid-set">
   <form class="bp768-wdn-col-two-thirds" method="post" action="<?php echo $context->getURL(); ?>" id="detailsForm">
       <?php $csrf = UNL_ENews_Controller::getCSRFHelper() ?>
       <input type="hidden" name="<?php echo $csrf->getTokenNameKey() ?>" value="<?php echo $csrf->getTokenName() ?>" />
       <input type="hidden" name="<?php echo $csrf->getTokenValueKey() ?>" value="<?php echo $csrf->getTokenValue() ?>">
       <ol style="margin-top:0">
           <li>
               <input type="hidden" name="_type" value="newsletter" />
               <input type="hidden" name="id" id="id" value="<?php echo $context->newsletter->id; ?>" />
               <label for="emailSubject"><span class="required">*</span> Email Subject <span class="helper">(Include story keywords!)</span></label>
               <input name="subject" type="text" value="<?php echo $context->newsletter->subject; ?>" id="emailSubject" />
           </li>
           <li>
               <label for="releaseDate">Release Date <span class="helper">(Will be sent at 7:00 am)</span></label>
               <input class="datepicker" name="release_date" type="text" size="10" value="<?php echo str_replace(' 00:00:00', '', $context->newsletter->release_date); ?>" id="releaseDate" />
           </li>
       </ol>
       <input type="submit" name="submit" value="Save" />
       <a class="wdn-button action preview" href="#" onclick="WDN.initializePlugin('modal', [function() {WDN.jQuery(this).colorbox({inline:true, href:'#sendPreview<?php echo $context->newsletter->id; ?>', open:true, width:'30%', title:'Send Newsletter Preview'}); return false;}]);">Send Preview</a>
   </form>
   <?php echo $savvy->render($context->newsletter, 'ENews/Newsletter/SendPreviewForm.tpl.php'); ?>
   <div class="email_addresses bp768-wdn-col-one-third">
       <h5>Distribute this newsletter to:</h5>
       <ul>
           <?php
           $existing_emails = $context->newsletter->getEmails()->getArrayCopy();
           foreach ($context->newsletter->newsroom->getEmails() as $email):
               $checked = false;
               if (in_array($email->id, $existing_emails)) {
                   $checked = true;
               }
           ?>
           <li>
               <form class="emailIndicator">
                   <?php $csrf = UNL_ENews_Controller::getCSRFHelper() ?>
                   <input type="hidden" name="<?php echo $csrf->getTokenNameKey() ?>" value="<?php echo $csrf->getTokenName() ?>" />
                   <input type="hidden" name="<?php echo $csrf->getTokenValueKey() ?>" value="<?php echo $csrf->getTokenValue() ?>">
                   <input type="checkbox" id="email_<?php echo $email->id; ?>" <?php if ($checked) echo 'checked="checked"'; ?> />
                   <label for="email_<?php echo $email->id; ?>" >
                       <?php echo $email->email; ?>
                   </label>
               </form>
               <form action="<?php echo $context->getURL(); ?>" method="post" class="remove email">
                   <?php $csrf = UNL_ENews_Controller::getCSRFHelper() ?>
                   <input type="hidden" name="<?php echo $csrf->getTokenNameKey() ?>" value="<?php echo $csrf->getTokenName() ?>" />
                   <input type="hidden" name="<?php echo $csrf->getTokenValueKey() ?>" value="<?php echo $csrf->getTokenValue() ?>">
                   <input type="hidden" name="newsletter_id" value="<?php echo $context->newsletter->id; ?>" />
                   <input type="hidden" name="newsroom_email_id" value="<?php echo $email->id; ?>" />
                   <input type="hidden" name="_type" value="removenewsletteremail" />
                   <input type="submit" value="Remove" />
               </form>
               <form action="<?php echo $context->getURL(); ?>" method="post" class="add email">
                   <?php $csrf = UNL_ENews_Controller::getCSRFHelper() ?>
                   <input type="hidden" name="<?php echo $csrf->getTokenNameKey() ?>" value="<?php echo $csrf->getTokenName() ?>" />
                   <input type="hidden" name="<?php echo $csrf->getTokenValueKey() ?>" value="<?php echo $csrf->getTokenValue() ?>">
                   <input type="hidden" name="newsletter_id" value="<?php echo $context->newsletter->id; ?>" />
                   <input type="hidden" name="newsroom_email_id" value="<?php echo $email->id; ?>" />
                   <input type="hidden" name="_type" value="addnewsletteremail" />
                   <input type="submit" value="Add" />
               </form>
           </li>
           <?php endforeach; ?>
       </ul>
    </div>
</div>
<div class="wdn-grid-set">
    <div class="wdn-col-one-third" id="drag_story_list">
    <?php $stories = $context->getRaw('available_stories'); ?>
    <?php foreach (array('news', 'event', 'ad') as $type): ?>
        <div id="<?php echo $type; ?>Available">
            <h3><?php echo ucfirst($type); ?> <span>Submissions</span><a href="#" class="showHide">Hide</a></h3>
            <div class="storyItemWrapper">
                <?php echo $savvy->render($stories->setType($type)); ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="wdn-col-two-thirds">
        <?php $context->newsletter->options = array('preview' => true); ?>
        <?php echo $context->newsletter->getRawObject()->getEmailHTML(); ?>
    </div>
</div>
