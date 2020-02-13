/** @type {HTMLDivElement} */
var popupParent = null
/** @type {HTMLIFrameElement} */
var popupIframe = null

/**
 * @param {string} url 
 */
function openPopup(url) {
    if (popupParent == null) {
        popupParent = document.createElement("div")
        popupParent.classList.add("popupParent")
        
        let popupWindow = document.createElement("div")
        popupWindow.classList.add("popupWindow")
        popupParent.appendChild(popupWindow)
        
        popupIframe = document.createElement("iframe")
        popupIframe.classList.add("popupIframe")
        popupWindow.appendChild(popupIframe)
    }
    
    document.body.appendChild(popupParent)
    popupIframe.src = url
}