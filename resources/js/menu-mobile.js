import gsap from 'gsap';

let lastScrollTop = 0;
const menu = document.getElementById("mobileMenu");
var windowWidth = window.innerWidth;

if (windowWidth < 480) {
    window.addEventListener("scroll", () => {
        const currentScroll = window.scrollY || document.documentElement.scrollTop;
    const windowHeight = window.innerHeight;
    const fullHeight = document.documentElement.scrollHeight;

    if (currentScroll > lastScrollTop || (currentScroll + windowHeight) >= fullHeight - 5) {
        gsap.to(menu, { y: 100, duration: 0.3, ease: "power2.out" });
    } else {
        gsap.to(menu, { y: 0, duration: 0.3, ease: "power2.out" });
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});
}
