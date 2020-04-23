/** @type {HTMLDivElement} */
var popupParent = null
/** @type {HTMLIFrameElement} */
var popupIframe = null
/** @type {HTMLDivElement} */
var popupSpinner = null

/**
 * @param {string} url 
 */
function openPopup(url) {
    if (popupParent == null) {
        popupParent = document.createElement("div")
        popupParent.classList.add("popupParent")
        
        popupParent.addEventListener("click", () => {
            closePopup()
        })
        
        let popupWindow = document.createElement("div")
        popupWindow.classList.add("popupWindow")
        popupParent.appendChild(popupWindow)
        
        popupIframe = document.createElement("iframe")
        popupIframe.classList.add("popupIframe")
        popupWindow.appendChild(popupIframe)

        popupSpinner = document.createElement("div")
        popupParent.appendChild(popupSpinner)
        popupSpinner.classList.add("spinner-border", "text-primary", "popup-spinner")
    }

    document.body.appendChild(popupParent)
    popupIframe.src = url
}

{
    let update = function() {
        if (popupIframe) {
            let popupWindow = popupIframe.parentElement
            if (popupIframe.src != "" && popupIframe.contentWindow && popupIframe.contentWindow.document && popupIframe.contentWindow.document.body && popupIframe.contentWindow.$) {
                const height = popupIframe.contentWindow.document.body.clientHeight + 50
                const heightString = (height) + "px"
                popupWindow.hidden = false
                if (popupWindow.style.height != heightString) popupWindow.style.height = heightString
                popupSpinner.hidden = true
            } else {
                popupWindow.style.height = "0"
                popupWindow.hidden = true
                popupSpinner.hidden = false
            }
        }
        requestAnimationFrame(update)
    }
    update()
}

window.addEventListener("keydown", (event)=>{
    if (event.key == "Escape") {
        closePopup()
    }
})

function closePopup() {
    if (popupIframe) {
        popupIframe.src = ""
        popupParent.remove()
    }
}