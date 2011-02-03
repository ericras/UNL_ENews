<?php
if (!$context->hasNotExpired()) {
    return;
}

if ($context->getColFromSort() == 'twocol') {
    $width = UNL_ENews_File_Image::FULL_AD_WIDTH;
    $height = UNL_ENews_File_Image::FULL_AD_HEIGHT;
} else {
    $width = UNL_ENews_File_Image::HALF_AD_WIDTH;
    $height = UNL_ENews_File_Image::HALF_AD_HEIGHT;
}

if ($file = $context->getFileByUse('originalimage')) {
    echo '<div style="background:#f4f2cc;padding:10px;margin-top:10px;margin-bottom:10px;">';
    if (!empty($context->website)) {
        echo '<a href="'.$context->website.'">';
    }

    echo '<img src="'.$file->getURL().'" style="width:'. $width .'px;height:'. $height .'px;" />';

    if (!empty($context->website)) {
        echo '</a>';
    }
    echo '</div>';
}
?>