<div class="sidebar-box search-form-wrap">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="form-group">
            <label for="s">
                <span class="screen-reader-text"><?php _e( 'Search for:', 'muzeum' ) ?></span>
                <button class="icon">
                    <ion-icon name="search"></ion-icon>
                </button>
            </label>
            <input type="search" class="form-control" placeholder="<?php _e( 'Search...', 'muzeum' ); ?>"
                value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
                <a href="#" class="close"><ion-icon name="close"></ion-icon></a>
        </div>
    </form>
</div>