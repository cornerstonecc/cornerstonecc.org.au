/**
 * Callback to handle when (1) page is loaded, and (2) window is resized.
 *
 * @param {Event} event - the passed event.
 * @returns {undefined}
 */
function updateCSSVarFromSiteHeaderHeight(event: Event): void {
  const rootElm = document.documentElement;
  const siteHeaderElm = document.querySelector('.home #site-header');

  if (siteHeaderElm) {
    const rect = siteHeaderElm.getBoundingClientRect();

    rootElm.style.setProperty(
        '--site-header-height',
        `${rect.height}px`
    );
  }
}

export default () => {
  window.addEventListener("load", updateCSSVarFromSiteHeaderHeight);
  window.addEventListener("resize", updateCSSVarFromSiteHeaderHeight);
}
