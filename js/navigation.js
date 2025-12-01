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


(function(){
    var lazyImages = [].slice.call(document.querySelectorAll('img.lazy-blur'));
    var loadedClass = 'loaded';
    var loadImage = function(img){
        if(img.dataset.src && !img.classList.contains(loadedClass)){
            img.src = img.dataset.src;
            img.addEventListener('load', function(){
                img.classList.add(loadedClass);
            });
        }
    };

    // Trigger load on ANY interaction
    var triggerLoad = function(){
        lazyImages.forEach(function(img){
            loadImage(img);
        });
        // Remove listeners after first trigger
        ['mousemove','mousedown','touchstart','scroll','keydown'].forEach(function(ev){
            window.removeEventListener(ev, triggerLoad);
        });
    };

    ['mousemove','mousedown','touchstart','scroll','keydown'].forEach(function(ev){
        window.addEventListener(ev, triggerLoad);
    });

})();