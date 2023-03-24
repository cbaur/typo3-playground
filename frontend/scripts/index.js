/**
 * jQuery on the window object
 */
//import $ from "expose-loader?exposes=$,jQuery!jquery";

/**
 * Bootstrap 5 - add more components if necessary
 * Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip
*/

//import * as BootstrapUtil from 'bootstrap/js/dist/util/index';
import { Tab, Collapse, Dropdown, Tooltip } from 'bootstrap';

/**
 * GLightbox: https://github.com/biati-digital/glightbox
 */
import GLightbox from 'glightbox';
GLightbox({
  selector: '*[data-lightbox]'
});

/**
 * Add js-cookie if needed: https://github.com/js-cookie/js-cookie
 */
// import Cookie from 'js-cookie';

/**
 * Slider: https://swiperjs.com/get-started
 * Modules: 
 * Virtual, Keyboard, Mousewheel, Navigation, Pagination, Scrollbar, Parallax, FreeMode, Grid, Manipulation,
 * Zoom, Lazy, Controller, A11y, History, HashNavigation, Autoplay, EffectFade, EffectCube, EffectFlip, EffectCoverflow
 * EffectCards, EffectCreative, Thumbs
 */
// Import Swiper and modules
// import Swiper, { Navigation, Pagination } from 'swiper';


// Your custom JS here...
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl)
})
