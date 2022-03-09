const tableSize = () =>{
    let smallWindow = window.innerWidth - 393;
        let tableWidth = document.getElementById('table-width');
    if(window.innerWidth >= 1024 && window.innerWidth <=1400){
        tableWidth.style.width = smallWindow+"px";
    } else {
        tableWidth.style.width = "100%";
    }
}
tableSize();
window.addEventListener('resize',tableSize);