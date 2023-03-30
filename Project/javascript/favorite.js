const request = new XMLHttpRequest();
var toggleDishFavorites = false;
var toggleRestaurantFavorites = false;

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function restaurantFavorite(element, id) {
    if (element.textContent == '\u2606') {
        request.open("get", "../api/api_favorite_restaurant.php?" + encodeForAjax({id: id}));
        request.send();
        element.textContent = '\u2605';
    } else {
        request.open("get", "../api/api_unfavorite_restaurant.php?" + encodeForAjax({id: id}));
        request.send();
        element.textContent = '\u2606';
    }
}

function dishFavorite(element, id) {
    if (element.textContent == '\u2606') {
        request.open("get", "../api/api_favorite_dish.php?" + encodeForAjax({id: id}));
        request.send();
        element.textContent = '\u2605';
    } else {
        request.open("get", "../api/api_unfavorite_dish.php?" + encodeForAjax({id: id}));
        request.send();
        element.textContent = '\u2606';
    }
}

async function showFavoriteRestaurants() {
    toggleRestaurantFavorites = !toggleRestaurantFavorites;
    const restaurants = document.getElementsByClassName("places");

    if(toggleRestaurantFavorites) {
        const response = await fetch('../api/api_get_favorite_restaurants.php');
        const favorites = await response.json();

        var checked = false;
        for(const restaurant of restaurants) {
            checked = false;

            for(const favorite of favorites) {
                if(favorite.id == restaurant.getAttribute("data-id")) {
                    checked = true;
                    break;
                }
            }

            if(!checked)
                restaurant.style.display = "none";
        }
    }
    else {
        for(const restaurant of restaurants) {
            restaurant.style.display = "inline-block";
        }
    }
}

async function showFavoriteDishes(id) {
    toggleDishFavorites = !toggleDishFavorites;
    const dishes = document.getElementsByClassName("dishinfo");

    if(toggleDishFavorites) {
        const response = await fetch('../api/api_get_favorite_dishes.php?id=' + id);
        const favorites = await response.json();

        var checked = false;

        for(const dish of dishes) {
            checked = false;

            for(const favorite of favorites) {
                if(favorite.id == dish.getAttribute("data-id")) {
                    checked = true;
                    break;
                }
            }

            if(!checked) {
                dish.style.display = "none";
            }
        }
    }
    else {
        for(const dish of dishes) {
            dish.style.display = "inline-block";
        }
    }
}
