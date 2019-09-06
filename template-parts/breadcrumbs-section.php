<section class="hero-sec mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                    the_archive_title( '<h1><b>', '</b></h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
				?>
                <nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <?php get_breadcrumb(); ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>