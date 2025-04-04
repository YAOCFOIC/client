<?php if (!empty($_SESSION['mensaje'])): ?>
    <div class="alert">
        <?= htmlspecialchars($_SESSION['mensaje']) ?>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>