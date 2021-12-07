function fillForm(ele){
    fetch('address', {
        method: 'get'
    })
    .then(response => response.json())
    .then(jsonData => populate(jsonData))
    .catch(err => {
        console.log(err);
    });
    ele.style.display = "none";
}
function populate(address)
{
    let forms = document.querySelectorAll('.form_group input');
    for(input of forms)
    {
        input.value = address[input['name']] ?? '';
    }
}