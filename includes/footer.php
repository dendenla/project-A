<?php
// includes/footer.php - Footer template
?>
    <!-- Footer -->
    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Website ini adalah media informasi untuk membantu siswa memahami berbagai jurusan yang tersedia di sekolah</p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>Email: info@sekolah.edu</p>
                <p>Telepon: (021) 123-4567</p>
            </div>
            <div class="footer-section">
                <h3>Ikuti Kami</h3>
                <p>
                    <a href="#">Facebook</a> | 
                    <a href="#">Instagram</a> | 
                    <a href="#">Twitter</a>
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Website Informasi Jurusan Sekolah. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo APP_URL; ?>assets/js/main.js"></script>
    <?php if (isset($extra_js)): ?>
        <script src="<?php echo APP_URL; ?>assets/js/<?php echo $extra_js; ?>"></script>
    <?php endif; ?>
</body>
</html>
