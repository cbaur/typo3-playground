/**
 * jQuery on the window object
 */
import $ from "expose-loader?exposes=$,jQuery!jquery";

/**
 * Bootstrap 4 - add more components if necessary
*/
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/tab';
import 'bootstrap/js/dist/util';

/**
 * GLightbox: https://github.com/biati-digital/glightbox
 */
import GLightbox from 'glightbox';
GLightbox({
  selector: '*[data-lightbox]'
})

/**
 * Add js-cookie if needed: https://github.com/js-cookie/js-cookie
 */
// import Cookie from 'js-cookie';

/**
 * Tiny Slider: https://github.com/ganlanyuan/tiny-slider
 */
// import {tns} from 'tiny-slider/frontend/tiny-slider.js';
// window.tns = tns;


// Your custom JS here...
