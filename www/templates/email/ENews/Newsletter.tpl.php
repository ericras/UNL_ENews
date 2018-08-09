<?php if (!empty($context->options['preview'])) : //For the preview building tool ?>
  <div id="previewWrapper" style="color:#494949; font-size: 12px; line-height: 140%; font-family: 'Lucida Grande',Verdana,Arial;">
<?php endif; ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td bgcolor="#FEFDFA" class="wdn-header-top">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="650" class="responsive-table">
                            <tr>
                                <td><a href="http://www.unl.edu/" target="_blank" style="text-decoration: none; color: #d00000;"><img src="https://www.unl.edu/images/email/4-1/41_01.gif" width="320" height="36" alt="" border="0" align="left" style="display: block;"></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="border-top:1px solid #EAE9E6">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td bgcolor="#FEFDFA">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="650" class="responsive-table">
                            <tr>
                                <td width="77" class="wdn-logo"><a href="http://www.unl.edu/" target="_blank"><img src="https://www.unl.edu/images/email/4-1/41_02.gif" width="77" height="83" alt="" border="0" align="left" style="display: block;"></a></td>
                                <td valign="middle" class="wdn-logo-lockup" style="font-size:38px; line-height:1; font-family: 'Arial Narrow', Arial, sans-serif; text-transform:uppercase; white-space:nowrap"><a href="<?php echo $context->getURL(); ?>" target="_blank" style="text-decoration: none; color:#474746"><?php echo UNL_ENews_Newsroom::getByID($context->newsroom_id)->name; ?></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#C80E13" style="padding: 10px 20px 10px 20px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="610" class="responsive-table" style="font-size:14px;font-family:Helvetica,Arial,sans-serif;color:#FFFFFF;">
                <tr>
                    <td class="unltoday-mast" align="left"><?php echo date('F j, Y', strtotime($context->release_date)); ?></td>
                    <td class="unltoday-mast" align="right"><i><?php echo UNL_ENews_Newsroom::getByID($context->newsroom_id)->subtitle; ?></i></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- Start main content -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:normal; min-width: 650px;" class="wrapper-table">
    <tr bgcolor="#F8F5EC">
        <td></td>
        <td style="padding:30px 15px 30px 15px" width="620" class="unltoday-padding">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="responsive-table" style="max-width: 620px;">
                <?php
                    $stories = $context->getStories();
                    if (!empty($context->options['preview'])) {
                        $stories->setIsPreview(true);
                    }
                    echo $savvy->render($stories, 'templates/html/ENews/Newsletter/Stories.tpl.php');
                ?>
            </table>
        </td>
        <td></td>
    </tr>
</table>
<!-- End main content -->

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height: normal;">
    <tr>
        <td bgcolor="#333332" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td style="padding: 20px 20px 20px 20px;">
                        <table width="610" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
                            <tr>
                                <td align="left" valign="middle" style="font-size: 10px; line-height: 16px; font-family: Verdana, sans-serif; color:#adacaa; -webkit-text-size-adjust: none">
                                    <span class="appleFooter" style="color:#adacaa; -webkit-text-size-adjust: none"><a style="color:#cfcfcf" href="<?php echo $context->newsroom->getSubmitURL(); ?>">Submit Your News</a> | <a style="color:#cfcfcf" href="<?php echo $context->getURL(); ?>">Read this newsletter on the web</a><br />
                                        &copy; <?php print date("Y")?> University of Nebraska&ndash;Lincoln<br />
                                        <?php echo $context->newsroom->getRaw('footer_text'); ?>
                                     </span></td>
                                <td width="111" valign="top" class="mobile-hide" style="padding-left:20px"><a href="http://www.unl.edu/" target="_blank" style="font-family: Verdana; color: #ffffff; font-size: 14px;"><img alt="University of Nebraska-Lincoln" src="https://www.unl.edu/images/email/4-1/wordmark.gif" width="111" height="43" style="display: block;" border="0"></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php if (!empty($context->options['preview'])) : //For the preview building tool ?>
  </div>
<?php endif; ?>

<?php if (!$context->options['preview']) : ?>
<img src="<?php echo $context->getOpenURL(); ?>?<?php echo time(); ?>" alt="" />
<?php endif; ?>
