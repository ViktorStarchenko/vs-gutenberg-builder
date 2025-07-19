
/**
 * ACCORDION
 */
jQuery(document).ready(function(){
    jQuery('body').on('click', function(e){
        if (e.target.classList.contains('vs-accordion_btn')) {
            e.target.classList.toggle('active');
            var panel = e.target.nextElementSibling;
            console.log(e.target);
            if (panel.style.maxHeight) {
                panel.classList.remove('active');
                panel.style.maxHeight = null;
            } else {
                panel.classList.add('active');
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        }
    })
});

jQuery('body').on('click', function(event) {

})