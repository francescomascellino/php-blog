<!-- 
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span>Connection Message: <?php echo $connection_message; ?></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> 
-->

<!-- SESSION MESSAGE -->
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo "Session message: " . $_SESSION['message']; ?>
        <button id="close-message-alert" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="clearSessionMessage()"></button>
    </div>
<?php endif; ?>

<!-- SESSION ERROR -->
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo "Session error: " . $_SESSION['error']; ?>
        <button id="close-error-alert" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="clearSessionError()"></button>
    </div>
<?php endif; ?>