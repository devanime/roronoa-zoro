<?php
/**
 * Expected:
 * @var string $video_id
 * @var WP_Image $image
 */
?>

<div class="inline-video js-modal-builder" data-modal-target="#inline-video-modal">
    <div class="inline-video__image" data-video-id="<?= $video_id; ?>">
        <?php if ($image) : ?>
            <?= $image; ?>
        <?php endif; ?>
    </div>
</div>
