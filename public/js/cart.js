const total = document.getElementById('total');
const subtotal = document.getElementById('subtotal');
const productTotal = document.getElementsByClassName('productTotal');
let whichItem = null;
let loggedIn = false;
let removeForm= null;

function updateQuantity(id , ele, login){
    if(login)
    {
        updateForm = ele.previousElementSibling;
        updateForm.action = updateForm.action.replace(/.$/, ele.value);
        updateForm.submit();
    }
    else
        addToCart(id, ele.value);
}

updateTotal();
function updateTotal(){
    if(!total)
        return;

    let sum = 0;
    for(let ele of productTotal)
        sum += parseInt(ele.innerText.slice(1));

    total.innerHTML = subtotal.innerHTML = '$'+sum;
}

function removeCart(ele ,id, isLogin){
    if(isLogin)
    {
        removeForm = ele.previousElementSibling;
        loggedIn = true;
    }
    whichItem = id;
    modal.style.display= 'grid';
}

let ok = document.querySelector('.modal-ok');

ok.addEventListener('click', function(){
    if(loggedIn)
        removeForm.submit();
    else
        addToCart(whichItem, undefined, true);
})
