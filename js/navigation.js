(function () {
	const menuToggle = document.querySelector('.menu-toggle');
	const mobileNav = document.getElementById('site-navigation');

	if (!menuToggle || !mobileNav) return;

	// Toggle mobile menu and hamburger icon
	menuToggle.addEventListener('click', function () {
		const isExpanded = this.getAttribute('aria-expanded') === 'true';

		this.setAttribute('aria-expanded', String(!isExpanded));
		mobileNav.classList.toggle('toggled');
		this.classList.toggle('active');
	});

	// Close menu when clicking outside
	document.addEventListener('click', function (e) {
		const isClickInside = mobileNav.contains(e.target) || menuToggle.contains(e.target);

		if (!isClickInside && mobileNav.classList.contains('toggled')) {
			mobileNav.classList.remove('toggled');
			menuToggle.classList.remove('active');
			menuToggle.setAttribute('aria-expanded', 'false');
		}
	});

	// ✅ Submenu toggle on mobile
	const submenuLinks = mobileNav.querySelectorAll('.menu-item-has-children > a');

	submenuLinks.forEach(link => {
		link.addEventListener('click', function (e) {
			if (window.innerWidth <= 980) {
				e.preventDefault(); // disable link on mobile

				const parentItem = this.parentElement;
				const subMenu = parentItem.querySelector('.sub-menu');

				if (subMenu) {
					parentItem.classList.toggle('submenu-open');
				}
			}
		});
	});
})();
