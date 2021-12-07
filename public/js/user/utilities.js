const cloak = document.getElementsByClassName('cloak');

function toggleForm(){
    
    for (const ele of cloak)
        ele.classList.toggle('hide');
    
}

// focus search bar
document.onkeydown = function (event) {
    if (event.key == '/') {
        document.querySelector('input').focus();
        return false;
    }
};
