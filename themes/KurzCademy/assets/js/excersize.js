/** @type {Object<string, Excersize>} */
var allExcersizes = {}

/**
 * @typedef {Array<string | [string]>} ExcersizeSettings
 * 
 */

class Excersize {
    constructor(target) {
        /** @type {HTMLElement} */
        this.target = target
        if ("name" in this.target.dataset) this.name = this.target.dataset["name"]
        else throw new Error("Missing data-name in excersize element", target)
        var code = JSON.parse(this.target.innerHTML)
        /** @type {Array<{answer : string, element : HTMLInputElement}>} */
        this.questions = []

        allExcersizes[this.name] = this

        this.build(code)
    }

    /**
     * @param {ExcersizeSettings} settings 
     */
    build(settings) {
        var pre = document.createElement("pre")
        this.target.innerHTML = ""
        this.target.appendChild(pre)

        settings.forEach(v => {
            if (v instanceof Array) {
                let input = document.createElement("input")
                pre.appendChild(input)
                input.classList.add("excersize-question")
                this.questions.push({ answer: v[0], element: input })
                input.addEventListener("keydown", ()=>{
                    input.classList.remove("excersize-question-right", "excersize-question-wrong")
                })
            } else {
                pre.appendChild(document.createTextNode(v))
            }
        })
    }

    submit() {
        this.questions.forEach(v=>{
            var correct = v.element.value == v.answer
            v.element.classList.add(correct ? "excersize-question-right" : "excersize-question-wrong")
        })
    }
}

window.addEventListener("load", ()=>{
    [...document.querySelectorAll(".excersize")].forEach(v=>{
        new Excersize(v)
    });

    [...document.querySelectorAll(".excersize-submit")].forEach(v=>{
        if (!("name" in v.dataset)) throw new Error("Missing data-name in excersize submit button", v)
        /** @type {string} */
        var name = v.dataset["name"]
        if (!(name in allExcersizes)) throw new Error("Missing linked excersize for submit button", v)
        v.addEventListener("click", ()=>{
            allExcersizes[name].submit()
        })
    });
})