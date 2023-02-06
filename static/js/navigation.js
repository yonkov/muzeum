/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var topNavigation, topMenu;
	if (document.getElementById( 'top-navigation' )) {
		topNavigation = document.getElementById( 'top-navigation' );
		topMenu = topNavigation.getElementsByTagName( 'ul' )[ 0 ];
		if ( ! topMenu.classList.contains( 'nav-menu' ) ) {
			topMenu.classList.add( 'nav-menu' );
		}
	}

	var siteNavigation = document.getElementById( 'site-navigation' );
	var menuButtons = document.querySelectorAll('.site-menu .menu-toggle');
	var siteMenu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	if ( ! siteMenu.classList.contains( 'nav-menu' ) ) {
		siteMenu.classList.add( 'nav-menu' );
	}

	// Toggle the .toggled class and the aria-expanded value each time a menu button is clicked.
	for (i = 0; i < menuButtons.length; ++i) {
		menuButtons[i].addEventListener( 'click', function(e) {
			e.preventDefault();
			var $self =this;
			var toggledIcon = this.childNodes[1].childNodes[1];
			toggledIcon.checked = !toggledIcon.checked;

			var toggledMenu = this.parentNode;
			toggledMenu.classList.toggle( 'toggled' );

			if ( this.getAttribute( 'aria-expanded' ) === 'true' ) {
				this.setAttribute( 'aria-expanded', 'false' );
			} else {
				this.setAttribute( 'aria-expanded', 'true' );
			}
			// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
			document.addEventListener( 'click', function( e ) {
				var isClickInside = toggledMenu.contains( e.target );
				if ( ! isClickInside ) {
					toggledMenu.classList.remove( 'toggled' );
					$self.setAttribute( 'aria-expanded', 'false' );
					toggledIcon.checked = false;
				}
			})

		})
	}

	// Get all the link elements within all site menus
	var primaryLinks = siteMenu.getElementsByTagName( 'a' );
	var topLinks = topMenu ? topMenu.getElementsByTagName( 'a' ) : '';

	var topNodes = Array.prototype.slice.apply(topLinks);
    var primaryNodes = Array.prototype.slice.apply(primaryLinks);
	var links = topNodes.concat(primaryNodes);

	// Get all the link elements with children within the menu.
	var linksWithChildren = document.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for (i = 0, len = links.length; i < len; i++) {
		links[i].addEventListener('focus', toggleFocus, true);
		links[i].addEventListener('blur', toggleFocus, true);
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for (i = 0, len = linksWithChildren.length; i < len; i++) {
		linksWithChildren[i].addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus(e) {
		if (window.matchMedia('(max-width: 600px)').matches) return;
		if ( e.type === 'focus' || e.type === 'blur' ) {
			var self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( e.type === 'touchstart' ) {
			var menuItem = this.parentNode;
			e.preventDefault();
			for (i = 0; i < menuItem.parentNode.children.length; ++i) {
				var link = menuItem.parentNode.children[i];
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}

	/* Top Menu Search form */
	var searchIcon = document.getElementsByClassName('search-icon')[0];
	var searchClose = document.getElementsByClassName('close')[0];

	if(searchIcon){
		searchIcon.addEventListener('click', function(e){
			e.preventDefault();
			var searchForm = this.parentNode;
			this.parentNode.classList.toggle('open');
	
			searchClose.addEventListener('click', function(e){
				e.preventDefault();
				searchForm.classList.remove('open');
			})
	
		})

	}

}() );