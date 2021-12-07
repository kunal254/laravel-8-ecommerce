const aside = document.querySelector('aside');
const filter_sort = document.querySelector('.filter-sort');

if(filter_sort)
filter_sort.addEventListener('click', function (event) {
    const item = event.target;
    if (item.tagName == 'BUTTON') {
        if (item.innerHTML == 'Filter')
            hide_show("block", "none");
        else
            hide_show("none", "block");

        t_aside();
    }
});

function hide_show(filter, sort) {
    document.querySelector('.filter').style.display = filter;
    document.querySelector('.sort').style.display = sort;
}

function t_aside() {
    aside.classList.toggle('open');
}

// handle query string
function updateQuery(key, value) {
    window.location.href = getQuery(window.location.href, key, value);
}
function getQuery(uri, key, value)
{
    let regex = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    let separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(regex)) {
        return uri.replace(regex, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}
