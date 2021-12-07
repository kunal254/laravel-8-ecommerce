// category listing
let dels = document.getElementsByClassName('delete');
let form;
let ok = document.querySelector('.modal-ok');

ok.addEventListener('click', function(){
    document.querySelector("[data-form='"+form+"']").submit();
})

for(let del of dels){
    del.style.cursor = "pointer";
    del.addEventListener('click', function(){
        modal.style.display = "grid";
        form = del.dataset.remove;
    });
}
