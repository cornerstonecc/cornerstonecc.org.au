/**
 * Move the homepage splash image up by an amount equal to the height of the
 * #site-header navigation. Updates on `window.load` and `window.resize`.
 */
import updateCSSVarFromSiteHeader from "./utils/update-css-var-from-site-header";
updateCSSVarFromSiteHeader();


/**
 * Polyfill for CSS `scroll-behavior: smooth;`
 * (As of 2020-12 only Safari will load this.)
 */
import smoothscrollPolyfill from 'smoothscroll-polyfill';
import 'smoothscroll-anchor-polyfill';  // Extend smoothscroll-polyfill to work on anchor links

smoothscrollPolyfill.polyfill();  // Activate smoothscroll-polyfill
