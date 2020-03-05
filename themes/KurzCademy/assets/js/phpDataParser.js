/**
 * @param {string} data 
 */
function parsePHPData(data) {
    var source = data
    var reader = document.createElement("div")
    reader.innerHTML = source
    return JSON.parse(reader.innerText)
}