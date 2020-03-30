/**
 * @param {string} data 
 */
function parsePHPData(data) {
    if (data.length == 0) return null

    var source = data
    var reader = document.createElement("div")
    reader.innerHTML = source
    return JSON.parse(reader.innerText)
}