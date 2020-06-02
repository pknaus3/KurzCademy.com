export function processAxiosError(data: Record<string, string[] | string> | string) {
    var processString = (string: string) => {
        if (string.startsWith("<!")) {
            let tem = document.createElement("template")
            tem.innerHTML = string
            return tem.content.querySelector(".exception-name-block > div")?.innerHTML ?? "Failed to parse error"
        } else {
            return string
        }
    }

    var processUnknown = (data: Record<string, string[] | string> | string | string[]): string => {
        if (typeof data == "string") {
            return processString(data)
        } else if (typeof data == "object") {
            if (data instanceof Array) {
                return data.map(v => processUnknown(v)).join("\n")
            } else {
                return Object.values(data).map(v => processUnknown(v)).join("\n")
            }
        } else {
            return "" + data
        }
    }

    return processUnknown(data)
}