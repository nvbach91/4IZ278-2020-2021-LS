window.bootstrap = require('bootstrap');

$(document).ready(() => {
    lazyload();

    const pillElements = document.querySelectorAll('a[data-bs-toggle="pill"]')

    pillElements.forEach((element) => {
        element.addEventListener('shown.bs.tab', function (event) {
            localStorage.setItem('lastItem', '#' + event.target.getAttribute('id'));
        });
    });

    showLastProfileTab();
});

const token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

window.clearLocalStorage = () => localStorage.clear();

window.itemCartUp = function (element, price, event_id) {
    let result = handleCartItemUpDown(element, price, event_id, true);
    result = new Intl.NumberFormat('cs-CZ').format(result);
    document.getElementById('total-price').textContent = result.toString();

    axios.post('/cart/update', {
        event_id: event_id,
        increase: 1
    })
        .then(response => console.log(response.data))
        .catch(response => console.log(response.data));
}

window.itemCartDown = function (element, price, event_id) {
    let result = handleCartItemUpDown(element, price, false);
    result = new Intl.NumberFormat('cs-CZ').format(result);
    document.getElementById('total-price').textContent = result.toString();

    axios.post('/cart/update', {
        event_id: event_id,
        increase: 0
    })
        .then(response => console.log(response.data))
        .catch(response => console.log(response.data));
}

window.handleCartItemUpDown = (element, price, up) => {
    const inputEl = up ? element.previousElementSibling : element.nextElementSibling;
    const attributeName = up ? 'max' : 'min';
    let totalString = document.getElementById('total-price').textContent;
    const replaceStrings = [' ', '\s', "\u00A0", ','];
    replaceStrings.forEach(value => {
        const replaceValue = value === ',' ? '.' : '';
        totalString = totalString.replaceAll(value, replaceValue);
    });
    const totalBefore = parseFloat(totalString);
    const valueBefore = parseInt(inputEl.getAttribute('value'));
    const attribute = parseInt(inputEl.getAttribute(attributeName));
    up ? inputEl.stepUp(1) : inputEl.stepDown(1);
    if (valueBefore !== attribute) {
        up
            ? inputEl.setAttribute('value', (valueBefore + 1).toString())
            : inputEl.setAttribute('value', (valueBefore - 1).toString());
    }

    return valueBefore === attribute
        ? totalBefore
        : (up ? totalBefore + price : totalBefore - price);
}

topButton = document.getElementById("top-button");

window.onscroll = function() {
    scrollFunction()
};

window.scrollFunction = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        topButton.style.display = "flex";
    } else {
        topButton.style.display = "none";
    }
}

window.topFunction = function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

window.changeSortOrder = () => {
    const element = document.getElementById('sort-order-icon');
    if (element.classList.contains('fa-sort-amount-up')) {
        element.classList.remove('fa-sort-amount-up');
        element.classList.add('fa-sort-amount-down');
    } else {
        element.classList.remove('fa-sort-amount-down');
        element.classList.add('fa-sort-amount-up');
    }

    const sortOrder = document.getElementById('sort-order');
    const newOrder = sortOrder.getAttribute('data-sort') === 'asc' ? 'desc' : 'asc';
    sortOrder.setAttribute('data-sort', newOrder);
    changeSortBy();
}

window.changeSortBy = () => {
    const sportFilter = document.getElementById('sport-filter').value;
    filterSport(sportFilter);
}

window.filterSport = (value) => {
    const orderBy = document.getElementById('sort-by').value;
    const order = document.getElementById('sort-order').getAttribute('data-sort');

    axios.get('/events/get', { params: { filter: value, by: orderBy, order: order } } )
        .then(response => {
            console.log(response.data);
            if (response.status === 200) {
                document.getElementById('events-group-wrapper').innerHTML = response.data;
            }
        })
        .catch(response => console.log(response.data));
}

/**
 * Function to handle user favoriting or unfavoriting of sport
 * @param sport_id - id of sport
 */
window.favoriteSport = (sport_id) => {
    const element = document.getElementById(sport_id.toString());

    if (element.classList.contains('fa-thumbs-up')) {
        element.classList.remove('fa-thumbs-up');
        element.classList.add('fa-thumbs-down');
    } else {
        element.classList.remove('fa-thumbs-down');
        element.classList.add('fa-thumbs-up');
    }

    axios.post('/sports/' + sport_id + '/favorite')
        .then()
        .catch(response => console.log(response.data));
}

window.showLastProfileTab = () => {
    const lastItem = localStorage.getItem('lastItem');

    if (lastItem) {
        const pillElement = document.querySelector(lastItem);
        const tab = new bootstrap.Tab(pillElement);
        tab.show();
    }
}

window.showOrHideChangeImageInput = ($sport_id) => {
    const element = document.getElementById('change-image-input-' + $sport_id);
    element.style.display = element.style.display === 'none' ? 'flex' : 'none';
    element.style.display === 'flex' && element.firstElementChild.firstElementChild.focus();
}

window.handleSportCheckbox = () => {
    const selectEl = document.getElementById('select-sport');
    const inputNameEl = document.getElementById('sport-input');
    const inputImgEl = document.getElementById('sport-input-img');

    selectEl.disabled = !selectEl.disabled;
    inputNameEl.disabled = !inputNameEl.disabled;
    inputImgEl.disabled = !inputImgEl.disabled;
}

