<section class="wdn-grid-set">
    <div class="bp768-wdn-col-three-fifths">
        <?php
        echo $savvy->render($context, 'ENews/Newsroom/EditForm.tpl.php');
        echo $savvy->render($context->getUsers());
        echo $savvy->render($context, 'ENews/Newsroom/AddUserForm.tpl.php');
        ?>
    </div>
    <div class="bp768-wdn-col-two-fifths">
        <?php
        echo $savvy->render($context->getEmails());
        echo $savvy->render($context, 'ENews/Newsroom/AddEmailForm.tpl.php');
        ?>
    </div>
</section>
