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
        
        ['mousemove','mousedown','touchstart','scroll','keydown'].forEach(function(ev){
            window.removeEventListener(ev, triggerLoad);
        });
    };

    ['mousemove','mousedown','touchstart','scroll','keydown'].forEach(function(ev){
        window.addEventListener(ev, triggerLoad);
    });

})();