const pageFile = document.getElementById("add-file-page")
const formScreen = document.getElementById("request-file")
const label = document.querySelectorAll("label")
var isShowed = false

pageFile.style = `
            width: 100%;
            height: 20vh;
            background: rgba(42,41,41,0);
            position: absolute;
            bottom: 0;
            // display: none;
            overflow: hidden;
`
formScreen.style = `
            transform: translateY(100%);
            width: 100%;
            height: 100%;
            gap: 30px;
            padding: 30px 100px;
            background: white;
            transition: all .5s;
`
document.getElementById("button-add").addEventListener("click", () => {
    formScreen.style.transition = "transition: all .5s;"
    if(isShowed){
        displayElement = "none"
        transformElement = "100"
    }else{
        transformElement = "0"
        displayElement = "block"
    }
    isShowed = !isShowed
    pageFile.style.display = displayElement
    formScreen.style.transform = `translateY(${transformElement}%)`
})
label.forEach((element) => element.classList.add("display-column"))

var transformText = (elements) => {
    for (const element of elements) {
        element.innerText = Number(element.textContent).toFixed(2)
    }
}

var formateFloatsDatas = () => {
    const paragraphUsed = document.getElementById("field-used")
    const paragraphFree = document.getElementById("field-free")

    transformText([paragraphFree, paragraphUsed])
}
formateFloatsDatas()

var animateBoxMessage = () => {
    let progressBar = document.getElementById("box-progress")
    let stateProgress = 100
    try {
        progressBar.style.transition = "all .5s"
        setInterval(() => {
            if(stateProgress > 0) {
                stateProgress -= 20

                console.log(stateProgress)
                progressBar.style.width = `${stateProgress}%`
            }else{
                clearInterval()
                closeBoxMessage()
            }
        }, 1000)   
    } catch (error) {
        console.error(error)
    }
}
animateBoxMessage()

var closeBoxMessage = () => {
    document.getElementById("box-message").style.left = "-100%"
}

var asideBar = document.getElementById("screen-content")
var divAsideBar = document.getElementById("side-account-info")
document.getElementById("btn-show-side-bar").addEventListener("click", () => {
    divAsideBar.style.display = "block"
    setTimeout(() => {
        asideBar.style.transform = "translateX(0%)"
    }, 200)
})
document.getElementById("btn-close-aside-bar").addEventListener("click", () => {
    asideBar.style.transform = "translateX(-100%)"
    setTimeout(() => {
        divAsideBar.style.display = "none"
    }, 400)
})