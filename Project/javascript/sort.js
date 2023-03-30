function sortRestaurants(element) {
    if (element.textContent == "Review \u2B9F") {
        element.textContent = "Review \u2B9D";
    } else {
        element.textContent = "Review \u2B9F";
    }
    const parentNode = document.getElementById("restaurants");
    parentNode.innerHTML == '';
    const restaurants = document.getElementsByClassName("places");
    [].slice.call(restaurants).sort(function(a, b) {
        if(isNaN(a) || isNaN(b)) {
            console.log("here");
            return -1;
        }
        return parseFloat(a.getElementsByClassName("avgscore")[0].innerText) - parseFloat(b.getElementsByClassName("avgscore")[0].innerText);
    }).forEach(function(val, index) {
        parentNode.appendChild(val);
    })

}