let html = document.documentElement
let toggleMode = document.getElementById("toggleMode")

html.setAttribute('data-bs-theme', localStorage.getItem('theme'))
toggleMode.setAttribute('src',localStorage.getItem('toggleIcon') ?? toggleMode.getAttribute('src'))

function mod(btn){
    let form = btn.parentElement.nextElementSibling
    if(form.classList.contains("visually-hidden")){
        form.classList.remove("visually-hidden")
        btn.textContent = "Cerrar"
    } else {
        form.classList.add("visually-hidden")
        btn.textContent = "Modificar"
    }
}

function toggle(btn){
 let img = btn.querySelector('img')
 let path = img.getAttribute('src')

 if(html.getAttribute('data-bs-theme') == 'dark'){
  html.setAttribute('data-bs-theme', 'light')
  path = path.replace(/sun/,'moon')
  localStorage.setItem('theme','light')
 }else{
  html.setAttribute('data-bs-theme', 'dark')
  path = path.replace(/moon/,'sun')
  localStorage.setItem('theme','dark')
 }

  img.setAttribute('src',path)
  localStorage.setItem('toggleIcon',path)
}

function icon(btn){
 let img = btn.querySelector('img')
 let path = img.getAttribute('src')
 let count = btn.nextElementSibling
 let num = parseInt(count.textContent,10)

 if(path.search(/heart-filled/) > 0){
  path = path.replace(/heart-filled/,'heart')
  num = num - 1
 }else if(path.search(/bookmark-filled/) > 0){
  path = path.replace(/bookmark-filled/,'bookmark')
  num = num - 1
 }else if(path.search(/heart/) > 0){
  path = path.replace(/heart/,'heart-filled')
  num = num + 1
 }else if(path.search(/bookmark/) > 0){
  path = path.replace(/bookmark/,'bookmark-filled')
  num = num + 1
 }

 img.setAttribute('src',path)
 count.textContent = num
}

window.mod = mod;
window.toggle = toggle;
window.icon = icon;
