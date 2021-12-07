const aside = document.querySelector('aside');
const ham = document.querySelector('.ham');
const cover = document.querySelector('.cover');

ham.addEventListener('click', function(event){
    aside.classList.add('open');
    cover.style.display = "block";
});

cover.addEventListener('click', function(event){
    aside.classList.remove('open');
    cover.style.display = "none";
});

// aside has sub-menu
const hasSub = document.getElementsByClassName('has-sub');

for(let item of hasSub){

    item.addEventListener('click', function(){
        let sel = this.getElementsByClassName('sub')[0];
        sel.classList.toggle('sub-open');
    });
}
// keep aside sub menu open when link inside is clicked
let keepOpen = document.querySelector('.'+window.location.pathname.split('/')[2]);
if(keepOpen){
    keepOpen.classList.add('sub-open');
}


// modal
const modal = document.querySelector('.modal-container');

function closeModal(){
    modal.style.display = "none";
}