<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <button id="close-error-alert" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>