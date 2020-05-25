<?php if (isset($message_success) && $message_success): ?>
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-xs-12">
            <div class="alert alert-success"><?= $message_success ?></div>
        </div>
    </div>
<?php endif ?>

<?php if (isset($message_error) && $message_error): ?>
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-xs-12">
            <div class="alert alert-danger"><?= $message_error ?></div>
        </div>
    </div>
<?php endif ?>

<?php if (isset($message_info) && $message_info): ?>
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-xs-12">
            <div class="alert alert-info"><?= $message_info ?></div>
        </div>
    </div>
<?php endif ?>
