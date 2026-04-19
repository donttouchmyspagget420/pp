const str = "<dialog open><form action='' method='post' class='container'><div class='input-group'><input class='form-control' name='comentario'><input class='btn btn-outline-info' type='submit' value='enviar'></div></form></dialog>"
let bool = false

function mod(btn){
 if(bool == false){
  btn.innerHTML += str
  bool = true
 }
}

function toggle(btn){
 let html = document.documentElement;
 let img = btn.querySelector('img')
 let path = img.getAttribute('src')

 if(html.getAttribute('data-bs-theme') == 'dark'){
  html.setAttribute('data-bs-theme', 'light')
  path = path.replace(/sun/,'moon')
  img.setAttribute('src',path)
 }else{
  html.setAttribute('data-bs-theme', 'dark')
  path = path.replace(/moon/,'sun')
  img.setAttribute('src',path)
 }
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
