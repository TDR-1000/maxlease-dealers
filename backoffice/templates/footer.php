    </div>
    <!--end: Container -->

    <footer class="text-muted bg-light mt-auto pt-3 pb-1 text-center">
        <div class="container">
            <p>Copyright by © <?= WEBSITE_NAME ?> <?= date('Y') ?></p>
        </div>
    </footer>
</div>
<!--end: Cover Container -->


<script src="assets/js/vendor/jquery.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/vendor/jquery-validate/jquery.validate.min.js"></script>
<script src="assets/js/app/bootstrap.php"></script>
<script src="assets/js/app/common.js"></script>

<?php if (MAXLang::getLanguage() != DEFAULT_LANGUAGE) : ?>
    <script src="assets/js/vendor/jquery-validate/localization/messages_<?= MAXLang::getLanguage() ?>.js"></script>
<?php endif; ?>
