<!-- 
 *  this file is included inside of every webpages that requires a footer 
 *  css: footer.css
 *  location: public\assets\css\footer.css
 * -->
<footer>
        <div class="footer-title">
            <h2>INM Audio</h2>
        </div>
        
            <ul class="link-a">
                <li>
                    <a href="<?= base_url('/') ?>">Home</a>
                </li>

                <li>
                    <a href="<?= base_url('/library') ?>">Gear Library</a>
                </li>

                <li>
                    <a href="<?= base_url('/community') ?>">IEM Community</a>
                </li>

                <li>
                    <a href="<?= base_url('/customize') ?>">Customize</a>
                </li>

                <li>
                    <a href="<?= base_url('/shop') ?>">Shop</a>
                </li>   
            </ul>
        
        <div class="media">
            <a href="<?= base_url('') ?>"><i class="fa-brands fa-facebook"></i></a>
            <a href="<?= base_url('') ?>"><i class="fa-brands fa-instagram"></i></a>
        </div>  
</footer>