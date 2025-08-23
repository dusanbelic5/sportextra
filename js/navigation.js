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

	// Submenu toggle only on arrow
	const submenuToggles = mobileNav.querySelectorAll('.menu-item-has-children');

	submenuToggles.forEach(item => {
		// create arrow element
		const toggle = document.createElement('span');
		toggle.classList.add('submenu-toggle');
		item.appendChild(toggle);

		toggle.addEventListener('click', function (e) {
			e.preventDefault();
			item.classList.toggle('submenu-open');
		});
	});
})();
