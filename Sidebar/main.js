/*===== EXPANDER MENU  =====*/ 
const showMenu = (toggleId, navbarId, bodyId)=>{
    const toggle = document.getElementById(toggleId),
    navbar = document.getElementById(navbarId),
    bodypadding = document.getElementById(bodyId)
    var collapseMenus = document.getElementsByClassName("collapse__menu");
  
  
  
    if(toggle && navbar){
      toggle.addEventListener('click', ()=>{
        navbar.classList.toggle('expander')
  
        bodypadding.classList.toggle('body-pd')
        for (var i = 0; i < collapseMenus.length; i++) {
          collapseMenus[i].classList.remove("showCollapse");
      }
      })
    } 