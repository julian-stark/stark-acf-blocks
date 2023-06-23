
document.addEventListener('DOMContentLoaded', function() {

    const sal_animation = sal({
        threshold: 0,
    });
    const switchAnimations = () => {
    if (window.innerWidth < 768) {
        sal_animation.reset();
        sal_animation.disable();
    } else {
        sal_animation.reset();
        sal_animation.enable();
    }
    };
    switchAnimations();
    window.addEventListener('resize', switchAnimations);

});